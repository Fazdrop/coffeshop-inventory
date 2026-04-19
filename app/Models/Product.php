<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //mass assignment: tabel yang boleh diisi manual
    protected $fillable = [
        'name',
        'stock',
        'unit',
        'base_price',
        'selling_price',
        'min_stock'
    ];
}
