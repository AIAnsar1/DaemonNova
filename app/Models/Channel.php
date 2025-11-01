<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Channel extends Model
{
    use HasFactory, QueryCacheable;

    protected $fillable = [
        'telegram_id',
        'username',
        'title',
        'description',
        'invite_link',
        'discussion_group_id',
        'discussion_group_link',
        'comments_enabled',
        'anti_spam_enabled',
        'ban_on_link_username',
        'banned_usernames',
        'banned_links',
        'members_count',
        'views_total',
        'last_synced_at',
    ];
    
    protected $casts = [
        'banned_usernames' => 'array',
        'banned_links' => 'array',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function advertisings()
    {
        return $this->hasMany(Advertising::class);
    }
}
