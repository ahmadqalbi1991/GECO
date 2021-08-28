<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['product_name', 'description', 'price', 'category', 'image', 'sku_code', 'is_active'];
}
