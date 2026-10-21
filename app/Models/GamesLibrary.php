<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GamesLibrary extends Model
{
    use HasFactory;

    protected $table = 'games__libraries';

    protected $fillable = [
        'category',
        'tag',
        'name',
        'description',
        'rating',
        'state',
        'image',
    ];
}