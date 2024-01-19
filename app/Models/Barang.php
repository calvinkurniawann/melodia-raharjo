<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'stok',
        'gambar'
    ];

    protected $guarded = [
        'id'
    ];

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_product', 'id_product', 'id_cart')->withPivot('kuantitas');
    }
}
