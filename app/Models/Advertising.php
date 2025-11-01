<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Advertising extends Model
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
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
