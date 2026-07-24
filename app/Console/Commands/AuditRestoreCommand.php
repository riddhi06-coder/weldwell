<?php

namespace App\Console\Commands;

use App\Support\AuditArchiver;
use Illuminate\Console\Command;

class AuditRestoreCommand extends Command
{
    protected $signature = 'audit:restore {file : Archive filename, e.g. activity-logs-2026-01.json.gz}';

    protected $description = 'Restore an archived audit-log file back into the database.';

    public function handle(AuditArchiver $archiver): int
    {
        $file = $this->argument('file');

        try {
            $restored = $archiver->restore($file);
        } catch (\Throwable $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        $this->info("Restored {$restored} log(s) from {$file}.");

        return self::SUCCESS;
    }
}
