<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecomcategory extends Model
{
    use HasFactory;

    protected $table = "ecomcategories"; 
    protected $fillable = [
        'name',
        'icon',
        'draft',
        'brief',
        'color',
        'priority'
    ];

      public function getIconAttribute($value)
    {
        return url('storage/icons/' . $value);
    }
}
