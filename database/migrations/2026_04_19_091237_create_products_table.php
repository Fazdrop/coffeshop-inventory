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
        Schema::create('products', function (Blueprint $table) {
            //database berisi stock product
            $table->id();
            $table->string('name'); //nama product
            $table->integer('stock')->default(0); //stock product
            $table->string('unit')->default('pcs'); //satuan product
            $table->decimal('base_price', 12, 2)->default(0); //harga beli
            $table->decimal('selling_price', 12, 2)->default(0);//harga jual
            $table->integer('min_stock')->default(3); //stok minimal untuk alert
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
