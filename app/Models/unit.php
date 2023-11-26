<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
    use HasFactory;
    protected $table = 'units';
    protected $fillable = [
        'nama'
    ]; 


    public function prices()
{
    return $this->hasMany(price::class);
}

}
