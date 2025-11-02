<?php

namespace App\Listeners;

use App\Events\ChannelVerified;
use App\Services\TelegramSyncService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SyncChannelData
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ChannelVerified $event): void
    {
        $channel = $event->channel;
        app(TelegramSyncService::class)->sync($channel);
    }
}
