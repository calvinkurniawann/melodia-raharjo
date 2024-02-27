<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';

    protected $guarded = [
        'id'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'id_order_detail');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    
}