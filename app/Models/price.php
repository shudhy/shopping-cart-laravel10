<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class price extends Model
{
    use HasFactory;
    protected $table = 'prices';
    protected $fillable = [
        'product_id',
        'unit_id',
        'price'
    ]; 

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    
}
