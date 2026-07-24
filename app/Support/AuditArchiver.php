<?php

namespace App\Support;

use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Offloads old audit logs out of the hot DB table into compressed monthly
 * archive files (never deletes them), and can restore an archive back.
 *
 * Files are grouped by the month the log was created:
 *   audit-archives/activity-logs-2026-01.json.gz
 */
class AuditArchiver
{
    public function disk(): \Illuminate\Contracts\Filesystem\Filesystem
    {
        return Storage::disk(config('audit.archive_disk', 'local'));
    }

    public function path(string $file = ''): string
    {
        return trim(config('audit.archive_path', 'audit-archives'), '/') . ($file ? '/' . $file : '');
    }

    /**
     * Archive every log older than `archive_after_days` (or an explicit cutoff)
     * into compressed monthly files, then remove those rows from the DB.
     *
     * @return array{archived:int, files:array<string>}
     */
    public function archive(?Carbon $cutoff = null): array
    {
        $cutoff ??= now()->subDays((int) config('audit.archive_after_days', 365))->startOfDay();
        $chunk  = (int) config('audit.chunk', 2000);

        $archived = 0;
        $touched  = [];

        // Group expiring rows by calendar month so each archive file is self-contained.
        ActivityLog::query()
            ->where('created_at', '<', $cutoff)
            ->orderBy('id')
            ->chunkById($chunk, function ($rows) use (&$archived, &$touched) {
                $byMonth = $rows->groupBy(fn ($r) => optional($r->created_at)->format('Y-m') ?: 'undated');

                foreach ($byMonth as $month => $group) {
                    $file = $this->appendToMonth($month, $group);
                    $touched[$file] = true;

                    ActivityLog::whereIn('id', $group->pluck('id'))->delete();
                    $archived += $group->count();
                }
            });

        return ['archived' => $archived, 'files' => array_keys($touched)];
    }

    /**
     * Append a batch of rows to a month's gzip file (merging with any existing
     * content so repeated runs accumulate rather than overwrite).
     */
    private function appendToMonth(string $month, $rows): string
    {
        $file = $this->path("activity-logs-{$month}.json.gz");
        $disk = $this->disk();

        $existing = [];
        if ($disk->exists($file)) {
            $existing = json_decode(gzdecode($disk->get($file)) ?: '[]', true) ?: [];
        }

        $payload = array_merge($existing, $rows->map(fn ($r) => $r->getAttributes())->all());

        $disk->put($file, gzencode(json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), 9));

        return "activity-logs-{$month}.json.gz";
    }

    /**
     * Restore an archive file's rows back into the DB (skips ids that already
     * exist so it is safe to re-run).
     *
     * @return int number of rows restored
     */
    public function restore(string $fileName): int
    {
        $file = $this->path($fileName);
        $disk = $this->disk();

        if (! $disk->exists($file)) {
            throw new \RuntimeException("Archive not found: {$fileName}");
        }

        $rows = json_decode(gzdecode($disk->get($file)) ?: '[]', true) ?: [];
        if (empty($rows)) {
            return 0;
        }

        $restored = 0;
        foreach (array_chunk($rows, (int) config('audit.chunk', 2000)) as $batch) {
            $ids     = array_column($batch, 'id');
            $present = ActivityLog::whereIn('id', $ids)->pluck('id')->all();

            $insert = array_values(array_filter($batch, fn ($r) => ! in_array($r['id'], $present)));
            if ($insert) {
                DB::table('activity_logs')->insert($insert);
                $restored += count($insert);
            }
        }

        return $restored;
    }

    /** List archive files with size + modified time, newest first. */
    public function listArchives(): array
    {
        $disk = $this->disk();
        $dir  = $this->path();

        if (! $disk->exists($dir)) {
            return [];
        }

        return collect($disk->files($dir))
            ->filter(fn ($f) => str_ends_with($f, '.json.gz'))
            ->map(fn ($f) => [
                'name'          => basename($f),
                'size'          => $disk->size($f),
                'last_modified' => $disk->lastModified($f),
            ])
            ->sortByDesc('name')
            ->values()
            ->all();
    }
}
