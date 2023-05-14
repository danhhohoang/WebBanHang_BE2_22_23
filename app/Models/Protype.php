<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Protype extends Model
{
    use HasFactory;
    protected $table = 'protypes';
    protected $fillable = [
        'name'
    ];
    function product(){
        return $this->hasMany(Product::class,'id');
    }
}
