<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficerSubject extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject',
    ];
}
/*
    M (OfficerSubject) : M (Officer)
*/