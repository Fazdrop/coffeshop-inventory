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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignID('user_id')->constrained();//siapa admin yang melakukan transaksi
            $table->decimal('total_price', 15, 2)->default(0);//total harga
            $table->decimal('pay_amount',15, 2)->default(0);//jumlah uang yang dibayar
            $table->decimal('change_amount',15, 2)->default(0);//kembalian
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
