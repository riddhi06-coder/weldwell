<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Offload old audit logs to compressed archive files monthly (never deletes them).
Schedule::command('audit:archive')->monthlyOn(1, '02:00')->withoutOverlapping();
