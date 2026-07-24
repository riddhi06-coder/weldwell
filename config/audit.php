<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Hot-window (days)
    |--------------------------------------------------------------------------
    | Logs newer than this stay in the live `activity_logs` table for instant
    | browsing/filtering in the admin panel. Logs OLDER than this are moved out
    | to compressed archive files by `php artisan audit:archive` — they are
    | never deleted, just offloaded so the table stays lean and fast.
    */
    'archive_after_days' => (int) env('AUDIT_ARCHIVE_AFTER_DAYS', 365),

    /*
    |--------------------------------------------------------------------------
    | Archive storage
    |--------------------------------------------------------------------------
    | Which filesystem disk + folder the compressed monthly archives live in.
    | Point 'disk' at 's3' (or any cloud disk) to keep archives off-server.
    */
    'archive_disk' => env('AUDIT_ARCHIVE_DISK', 'local'),
    'archive_path' => env('AUDIT_ARCHIVE_PATH', 'audit-archives'),

    /*
    |--------------------------------------------------------------------------
    | Batch size
    |--------------------------------------------------------------------------
    | How many rows to process per chunk while archiving, to keep memory flat
    | even when millions of rows are being offloaded.
    */
    'chunk' => (int) env('AUDIT_ARCHIVE_CHUNK', 2000),

];
