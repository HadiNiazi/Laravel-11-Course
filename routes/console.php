<?php

use Illuminate\Foundation\Inspiring;
use App\Console\Commands\DeleteOldPost;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Schedule::command(DeleteOldPost::class)->everyFiveSeconds();
