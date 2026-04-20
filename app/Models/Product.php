<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    //mencegah N+1 Queries Problem
    protected $with = ['unit'];

    //mass assignment: tabel yang boleh diisi manual
    protected $fillable = [
        'name',
        'stock',
        'unit_id',
        'base_price',
        'selling_price',
        'min_stock'
    ];
    //relasi ke tabel unit
    public function unit():BelongsTo{
        return $this->belongsTo(Unit::class);
    }
}
