<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Post extends Model
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
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
