<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Rennokki\QueryCache\Traits\QueryCacheable;
use Illuminate\Database\Eloquent\Model;


class Tag extends Model
{
    use HasFactory, QueryCacheable;

    protected $fillable = [
        'title',
    ];
}























