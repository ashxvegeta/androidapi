<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecomproduct extends Model
{
    use HasFactory;
    protected $table = "ecomproducts";
    protected $fillable = [
        'name',
        'image',
        'status',
        'price',
        'pricediscount',
        'stock',
    ];

    public function getImageAttribute($value)
    {
        return url('storage/icons/' . $value); // Change folder if needed
    }
}
