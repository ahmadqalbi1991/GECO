<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TOurnamentUser extends Model
{
    protected $table = 'tournament_users';
    protected $fillable = ['tournament_order_id', 'username', 'name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tournament_order() {
        return $this->belongsTo(TournamentOrder::class);
    }
}
