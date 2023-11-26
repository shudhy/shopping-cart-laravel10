<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function cart_items()
    {
        return $this->hasMany(cart_item::class, 'cart_id', 'id');
    }

    public function ongkir()
    {
        return $this->belongsTo(Ongkir::class, 'desa');
    }
}
