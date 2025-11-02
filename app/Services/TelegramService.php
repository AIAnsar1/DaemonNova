<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use SergiX44\Nutgram\Nutgram;

class TelegramService
{
    protected Nutgram $bot;

    public function __construct(Nutgram $bot)
    {
        $this->bot = $bot;
    }

    public function isBotAdmin(string $chatId): bool
    {
        try {
            $admins = $this->bot->getChatAdministrators(chat_id: $chatId);

            foreach ($admins as $admin)
            {
                if ($admin->user->is_bot && $admin->user->id === $this->bot->getMe()->id)
                {
                    return true;
                }
            }
            return false;
        } catch (\Throwable $e) {
            return false;
        }
    }
}


















