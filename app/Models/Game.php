<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games';
    protected $fillable = [
        'game_name',
        'game_type',
        'release_date',
        'description',
        'image',
        'tournament_allow',
        'is_active'
    ];
}
