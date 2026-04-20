<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //menampilkan barang
    public function index()
    {
        //ambil produk yang paling baru
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }
    public function create()
    {
        //arahkan ke view create
        $units = Unit::all();
        return view('products.create', compact('units'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        //validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'unit_id' => 'required|integer|exists:units,id', //validasi relasi
            'base_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'stock' => 'required|numeric',
            "min_stock" => 'required|numeric',
        ]);
        //tambahkan ke database
        Product::create($request->all());
        //kembalikan ke halam utama dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Barang Berhasil Ditambahkan');
    }

    public function edit(Product $product)
    {
        $units = Unit::all();
        return view('products.edit', compact('product', 'units'));
    }
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'unit_id' => 'required|integer|exists:units,id', //validasi relasi
            'base_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'stock' => 'required|numeric',
            "min_stock" => 'required|numeric',
        ]);
        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Data barang berhasil diedit');
    }
    public function destroy(Product $product){
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Data barang berhasil dihapus');
    }
}
