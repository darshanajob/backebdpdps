<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberPosition extends Model
{
    use HasFactory;
    protected $fillable = [
        'position',
    ];
}
/*
    M (MemberPosition) : M (Member)
*/