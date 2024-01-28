<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['barang_id', 'user_id', 'rating', 'comment'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
