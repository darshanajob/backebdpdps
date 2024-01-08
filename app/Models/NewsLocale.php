<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsLocale extends Model
{
    use HasFactory;
    protected $fillable = [
        'news_si',
        'news_en',
        'news_ta',
    ];
}
/*
    1 (News) : 1 (NewsLocale)
*/