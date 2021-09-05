<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TOurnamentUser extends Model
{
    protected $table = 'tournament_users';
    protected $fillable = ['tournament_order_id', 'username'];
}
