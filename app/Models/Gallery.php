<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'gallery_locales_id',
        'img',
    ];
}
/*
    1(GalleryLocale) : M (Gallery)
*/