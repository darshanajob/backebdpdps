<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News_locales extends Model
{
    use HasFactory;
    protected $fillable = [
        'news_si',
        'news_en',
        'news_ta',
        'news_id'
    ];
}
