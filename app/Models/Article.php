<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Rennokki\QueryCache\Traits\QueryCacheable;
use App\Contracts\SchedulableContent;
use Carbon\Carbon;

class Article extends Model implements SchedulableContent
{
    use HasFactory, QueryCacheable;

    protected $fillable = [
        'title',
        'slug',
        'author_name',
        'author_url',
        'published_at',
        'status',
        'telegraph_url',
        'views',
        'reactions_count',
        'channel_id',
        'last_synced_at',
        'language',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function getPublishTime(): ?Carbon
    {
        return $this->published_at;
    }

    public function isScheduled(): bool
    {
        return $this->status === 'scheduled' && $this->published_at && $this->published_at->isFuture();
    }

    public function publish(): void
    {
        // Пример публикации в Telegram
        app(\App\Services\TelegramPublisher::class)->publishArticle($this);

        $this->update([
            'status' => 'published',
            'published_at' => now(),
        ]);
    }
}
