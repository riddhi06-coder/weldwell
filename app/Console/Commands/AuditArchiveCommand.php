<?php

namespace App\Console\Commands;

use App\Support\AuditArchiver;
use Illuminate\Console\Command;

class AuditArchiveCommand extends Command
{
    protected $signature = 'audit:archive
        {--days= : Archive logs older than this many days (defaults to config audit.archive_after_days)}';

    protected $description = 'Offload old audit logs into compressed archive files (never deletes them).';

    public function handle(AuditArchiver $archiver): int
    {
        $days   = $this->option('days');
        $cutoff = $days !== null ? now()->subDays((int) $days)->startOfDay() : null;

        $effectiveDays = $days ?? config('audit.archive_after_days');
        $this->info("Archiving audit logs older than {$effectiveDays} days…");

        $result = $archiver->archive($cutoff);

        if ($result['archived'] === 0) {
            $this->line('Nothing to archive.');

            return self::SUCCESS;
        }

        $this->info("Archived {$result['archived']} log(s) into " . count($result['files']) . ' file(s):');
        foreach ($result['files'] as $file) {
            $this->line("  • {$file}");
        }

        return self::SUCCESS;
    }
}
