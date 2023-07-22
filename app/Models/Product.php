<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'image',
        'id_kategori',
        'description',
        'price'
    ]; 


    public function category()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
