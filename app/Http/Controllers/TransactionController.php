<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CashFlow;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    //
    public function index()
    {
        //ambil product yang stok nya masih ada
        $products = Product::where('stock', '>', 0)->get();
        return view('transactions.index', compact('products'));
    }

    public function store(Request $request)
    {
        // 1. Decode data JSON dari Alpine.js
        $items = json_decode($request->items, true);
        if (empty($items)) {
            return back()->with('error', 'Keranjang Masih Kosong');
        }
        //2. Gunakan Database Transaction agar aman
        DB::beginTransaction();
        try {
            //A. Simpan data utama transaksi
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'total_price' => $request->total_price,
                'pay_amount' => $request->pay_amount,
                'change_amount' => $request->pay_amount - $request->total_price
            ]);
            foreach ($items as $item) {
                $product = Product::find($item['id']);
                //B. Cek stock sekali lagi (keamanan extra)
                if ($product->stock < $item['qty']) {
                    throw new \Exception("Stock {$product->name} tidak cukup");
                }
                //C. Simpan Detail Transaction
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['qty'],
                    'price_at_time' => $item['price'],
                    'subtotal' => $item['qty'] * $item['price'],
                ]);
                //D. Potong Stock Barang
                $product->decrement('stock', $item['qty']);
            }

            //E. Catat ke uang kas(Cash Flow) HANYA SEKALI PER TRANSAKSI
            //1. Cari baris terakhir di tabel cash_flows untuk dapat saldo paling update
            $lastCash = CashFlow::orderBy('id', 'desc')->first();
            //2. Ambil nilai current_balance-nya. Kalau belum ada data sama sekali, set ke 0.
            $lastBalance = $lastCash ? $lastCash->current_balance : 0;
            //3. LOGIKA KRUSIAL: Saldo baru adalah Saldo Terakhir + Total Belanja Sekarang
            $newBalance = $lastBalance + $request->total_price;
            //4. Catat ke table Cash Flow sesuai $fillable model 
            CashFlow::create([
                'type' => 'income',
                'amount' => $request->total_price,
                'description' => 'Penjualan Nota #' . $transaction->id,
                'current_balance' => $newBalance,
            ]);
            
            DB::commit();
            return redirect()->route('transactions.index')->with('success', 'Transaksi Berhasil');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi Kesalahan ' . $e->getMessage());
        }
    }
}
