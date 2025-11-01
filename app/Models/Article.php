<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Article extends Model
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
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
