<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use SergiX44\Nutgram\Nutgram;
use Throwable;
use App\Models\{Article, Post, Advertising, Channel};


class TelegramPublisher
{
    protected Nutgram $bot;

    public function __construct(Nutgram $bot)
    {
        $this->bot = $bot;
    }

  
    public function publishArticle(Article $article): void
    {
        $channel = $article->channel;

        if (!$channel || !$channel->telegram_id)
        {
            throw new \Exception('❌ Канал не привязан или отсутствует Telegram ID.');
        }
        $message = $this->formatArticleMessage($article);

        try {
            $this->bot->sendMessage(chat_id: $channel->telegram_id,text: $message,parse_mode: 'MarkdownV2');

            $article->update([
                'status' => 'published',
                'published_at' => now(),
            ]);

            Log::info("✅ Статья опубликована в Telegram", [
                'article_id' => $article->id,
                'channel' => $channel->title,
            ]);

        } catch (\Throwable $e) {
            Log::error("❌ Ошибка публикации статьи: {$e->getMessage()}", [
                'article_id' => $article->id,
            ]);
            $article->update(['status' => 'failed']);
        }
    }

  
    public function publishPost(Post $post): void
    {
        $channel = $post->channel;

        if (!$channel || !$channel->telegram_id) 
        {
            throw new \Exception('❌ Канал не привязан или отсутствует Telegram ID.');
        }
        $message = $this->formatPostMessage($post);

        try {
            $this->bot->sendMessage(chat_id: $channel->telegram_id,text: $message,parse_mode: 'MarkdownV2');

            $post->update([
                'status' => 'published',
                'published_at' => now(),
            ]);

            Log::info("✅ Пост опубликован в Telegram", [
                'post_id' => $post->id,
                'channel' => $channel->title,
            ]);

        } catch (\Throwable $e) {
            Log::error("❌ Ошибка публикации поста: {$e->getMessage()}", [
                'post_id' => $post->id,
            ]);

            $post->update(['status' => 'failed']);
        }
    }

    public function publishAdvertising(Advertising $ad): void
    {
        $channel = $ad->channel;

        if (!$channel || !$channel->telegram_id) {
            throw new \Exception('❌ Канал не привязан или отсутствует Telegram ID.');
        }

        $message = $this->formatAdvertisingMessage($ad);

        try {
            $this->bot->sendMessage(
                chat_id: $channel->telegram_id,
                text: $message,
                parse_mode: 'HTML',
                reply_markup: $ad->cta_url
                    ? json_encode([
                        'inline_keyboard' => [
                            [['text' => '🔗 Подробнее', 'url' => $ad->cta_url]],
                        ],
                    ])
                    : null
            );

            $ad->update([
                'status' => 'published',
                'published_at' => now(),
            ]);

            Log::info("✅ Рекламный пост опубликован", [
                'advertising_id' => $ad->id,
                'channel' => $channel->title,
            ]);

        } catch (Throwable $e) {
            Log::error("❌ Ошибка публикации рекламы: {$e->getMessage()}", [
                'advertising_id' => $ad->id,
            ]);

            $ad->update(['status' => 'failed']);
        }
    }

    protected function formatArticleMessage(Article $article): string
    {
        $text = "<b>" . e($article->title) . "</b>\n\n";

        if ($article->description) 
        {
            $text .= e($article->description) . "\n\n";
        }
        if ($article->telegraph_url) 
        {
            $text .= "📖 <a href='" . e($article->telegraph_url) . "'>Читать полностью</a>";
        }
        return $text;
    }

  
    protected function formatPostMessage(Post $post): string
    {
        $text = "<b>" . e($post->title) . "</b>\n\n";

        if ($post->description) 
        {
            $text .= e($post->description);
        }
        return $text;
    }

    protected function formatAdvertisingMessage(Advertising $ad): string
    {
        $text = "💡 <b>" . e($ad->title) . "</b>\n\n";

        if ($ad->description) {
            $text .= e($ad->description) . "\n\n";
        }

        if ($ad->price) {
            $text .= "💰 Цена: <b>" . e($ad->price) . "</b>\n";
        }

        if ($ad->expires_at) {
            $text .= "📅 Действует до: " . e($ad->expires_at->format('d.m.Y H:i')) . "\n";
        }

        if ($ad->cta_url) {
            $text .= "\n<a href='" . e($ad->cta_url) . "'>🔗 Подробнее</a>";
        }

        return $text;
    }
}















