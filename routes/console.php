<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    Artisan::call('reminders:send-due-date');
})->everyMinute();
Schedule::call(function () {
    Artisan::call('borrows:reject-pending');
})->everyMinute();
