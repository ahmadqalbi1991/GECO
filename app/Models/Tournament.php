<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $table = 'tournaments';
    protected $fillable = [
        'tournament_title',
        'game_id',
        'tournament_start_date',
        'description',
        'rules',
        'status',
        'is_active',
        'image',
        'tournament_type',
        'max_allow',
        'start_time',
        'price'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game() {
        return $this->belongsTo(Game::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders() {
        return $this->hasMany(TournamentOrder::class);
    }
}
