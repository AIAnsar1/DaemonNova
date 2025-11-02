<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Rennokki\QueryCache\Traits\QueryCacheable;
use App\Contracts\SchedulableContent;
use Carbon\Carbon;
use App\Services\TelegramPublisher;


class Advertising extends Model implements SchedulableContent
{
    use HasFactory, QueryCacheable;

    protected $fillable = [
        'content',
        'title',
        'description',
        'published_at',
        'expires_at',
        'status',
        'telegram_post_id',
        'post_url',
        'link',
        'views',
        'reactions_count',
        'channel_id',
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
        app(TelegramPublisher::class)->publishAdvertising($this);

        $this->update([
            'status' => 'published',
            'published_at' => now(),
        ]);
    }
}
