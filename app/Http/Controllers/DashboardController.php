<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CashFlow;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(){
        //ambil saldo terakhir dari table cash_flows
        // jika tidak ada maka defaultnya adalah 0
        $currentBalance = CashFlow::orderBy('id', 'desc')->first()->current_balance ?? 0;
        //Menghitung jumlah produk yang stoknya sudah mencapai atau di bawah batas minimal (stok menipis)
        $lowStockCount = Product::whereColumn('stock', '<=', 'min_stock')->count();
        //Menghitung total penjualan hari ini
        $todaySales = Transaction::whereDate('created_at', today())->sum('total_price');

        return view('dashboard', 
        ['currentBalance'=> $currentBalance,
        'lowStockCount'=> $lowStockCount,
        'todaySales' => $todaySales,
        ]);
    }
}
