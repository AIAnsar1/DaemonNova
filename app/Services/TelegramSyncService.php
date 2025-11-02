<?php

namespace App\Services;

use App\Models\Channel;
use Illuminate\Support\Facades\{Http, Log};
use SergiX44\Nutgram\Nutgram;



class TelegramSyncService
{
    protected Nutgram $bot;

    public function __construct(Nutgram $bot)
    {
        $this->bot = $bot;
    }

    public function sync(Channel $channel)
    {
        try {
            $chat = $this->bot->getChat(chat_id: $channel->telegram_id);
            $membersCount = $this->bot->getChatMemberCount(chat_id: $channel->telegram_id);
            $channel->update([
                'title' => $chat->title ?? $channel->title,
                'members_count' => $membersCount,
                'last_synced_at' => now(),
            ]);
            Log::info("Канал {$channel->title} синхронизирован успешно.");
        } catch (\Throwable $e) {
            Log::error("Ошибка синхронизации канала {$channel->title}: {$e->getMessage()}");
        }
    }
}




























