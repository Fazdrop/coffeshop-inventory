<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashFlow extends Model
{
    //mass assignment: table yang boleh diisi manual
    protected $fillable = [
        'type',
        'amount',
        'description',
        'current_balance'
    ];
}
