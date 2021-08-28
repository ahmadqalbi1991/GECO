<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'order_no',
        'user_id',
        'shipping_address',
        'client_name',
        'email',
        'order_time',
        'total',
        'order_status',
        'payment_status',
        'payment_method',
        'payment_time',
        'contact_number'
    ];
}
