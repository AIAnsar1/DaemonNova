<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\{ChannelCreated, ChannelVerified, ContentScheduled};
use App\Listeners\{SyncChannelData, VerifyBotAdminStatus, ScheduleContentPublication};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(ChannelCreated::class, VerifyBotAdminStatus::class);
        Event::listen(ChannelVerified::class, SyncChannelData::class);
        Event::listen(ContentScheduled::class, ScheduleContentPublication::class);
    }
}
