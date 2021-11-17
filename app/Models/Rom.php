<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rom extends Model
{
    use HasFactory;

    protected $fillable = [
        'release',
        'name',
        'videogame',
        'file',
        'thumbnail',
        'user_id'
    ];
}
