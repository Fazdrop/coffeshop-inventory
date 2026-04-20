<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionDetail extends Model
{
    //

    protected $fillable = ['transaction_id', 'product_id', 'quantity', 'price_at_time', 'subtotal'];
    public function product():BelongsTo{
        return $this->belongsTo(Product::class);
    }
}
