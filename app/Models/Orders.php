<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders'; // Table name in phpMyAdmin
    protected $fillable = ['user_id', 'total_price', 'status'];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id'); 
    }
}
