<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Cart extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function products()
    {
        return $this->belongsToMany(Barang::class, 'cart_product', 'id_cart', 'id_product')->withPivot('kuantitas');
    }

}
