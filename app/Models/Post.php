<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Carbon\Carbon;
use App\Contracts\SchedulableContent;
use App\Services\TelegramPublisher;


class Post extends Model implements SchedulableContent
{
    use HasFactory, QueryCacheable;

    protected $fillable = [
        'title',
        'description',
        'published_at',
        'status',
        'telegram_post_id',
        'post_url',
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
        app(TelegramPublisher::class)->publishPost($this);

        $this->update([
            'status' => 'published',
            'published_at' => now(),
        ]);
    }
}
