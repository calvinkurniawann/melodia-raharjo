<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class, 'id_order_detail');
    }

    // Change 'product_id' to 'id_product'
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}