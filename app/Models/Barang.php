<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';

    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'stok',
        'gambar',
        'category_id'
    ];

    protected $guarded = [
        'id'
    ];

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_product', 'id_product', 'id_cart')->withPivot('kuantitas');
    }

    public function reviews()
    {
    return $this->hasMany(Review::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
