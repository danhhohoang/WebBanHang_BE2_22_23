<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'type_id',
        'price',
        'image1',
        'image2',
        'image3',
        'image4',
        'description',
        'information',
        'weight',
        'sales',
        'featured',
        'exp',
        'created_at'
    ];
    function protype()
    {
        return $this->belongsTo(Protype::class, 'type_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
