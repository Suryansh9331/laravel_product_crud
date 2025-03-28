<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items'; // Table name in phpMyAdmin
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    public function order()
    {
        return $this->belongsTo(Orders::class,'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class ,'product_id');
    }
}
