<?php

namespace App\Listeners;

use App\Events\{ChannelCreated, ChannelVerified};
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\TelegramService;
use Illuminate\Support\Facades\Log;


class VerifyBotAdminStatus
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
    public function handle(ChannelCreated $event): void
    {
        $channel = $event->channel;
        $telegram = app(TelegramService::class);

        try {
            $isAdmin = $telegram->isBotAdmin($channel->username);
            $channel->update(['bot_is_admin' => $isAdmin]);

            if ($isAdmin) 
            {
                event(new ChannelVerified($channel));
            }
        } catch (\Exception $e) {
            Log::error("Ошибка при проверке прав бота в канале {$channel->username}: {$e->getMessage()}");
            $channel->update(['bot_is_admin' => false]);
        }

    }
}
