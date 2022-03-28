<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_id', 'order_id', 'count'];
    public function Order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function Product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
}

