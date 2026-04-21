<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //
    public function index(Request $request){
        //ambil tanggal dari filter 
        $startDate = $request->input('start_date', date('Y-m-d'));
        $endDate = $request->input('end_date', date('Y-m-d'));

        //ambil data transaksi berdasarkan rentang tanggal
        //menggunakan eager loading 'details.product' dan 'user' agar efisien (bebas N+1)
        $transactions = Transaction::with(['details.product', 'user'])
        ->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate])->latest()
        ->get();

        //hitung total omset dari transaksi yang difilter
        $totalRevenue = $transactions->sum('total_price');
        return view('reports.index', compact('transactions', 'totalRevenue','startDate', 'endDate'));

    }
}

