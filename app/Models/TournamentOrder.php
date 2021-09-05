<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class TournamentOrder extends Model
{
    protected $table = 'tournament_orders';
    protected $fillable = ['user_id', 'tournament_id', 'points', 'team_status', 'team_logo', 'team_title'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tournament() {
        return $this->belongsTo(Tournament::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users() {
        return $this->hasMany(TOurnamentUser::class);
    }
}
