<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ongkir extends Model
{
    use HasFactory;
    protected $table = 'ongkir';

    protected $fillable = [
        'desa_asal',
        'desa_tujuan',
        'biaya',
    ];
}
