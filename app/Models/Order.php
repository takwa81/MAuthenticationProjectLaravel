<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ["order_date", "status"];
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
