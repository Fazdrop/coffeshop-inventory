<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CashFlow;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(){
        //ambil saldo terakhir dari table cash_flows
        $currentBalance = CashFlow::orderBy('id', 'desc')->first()->current_balance ?? 0;
        $lowStockCount = Product::whereColumn('stock', '<=', 'min_stock')->count();
        return view('dashboard', ['currentBalance'=> $currentBalance,'lowStockCount'=> $lowStockCount]);
    }
}
