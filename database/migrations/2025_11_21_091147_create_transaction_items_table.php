<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaction_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transactions')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->unsignedInteger('quantity'); // Jumlah produk dalam transaksi ini
            
            // Tambahkan compound primary key untuk memastikan kombinasi unik
            $table->unique(['transaction_id', 'product_id']); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction_items');
    }
};