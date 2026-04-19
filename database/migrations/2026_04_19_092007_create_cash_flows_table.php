<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cash_flows', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['income', 'expense']);//Pemasukan atau pengeluaran
            $table->decimal('amount', 15, 2); //jumlah uangnya
            $table->string('description'); //keterangan (Jual kopu/ Beli sabun)
            $table->decimal('current_balance',15, 2); //saldo setelah transaksi 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_flows');
    }
};
