<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique(); // Stock Keeping Unit - Harus UNIK
            $table->string('name');
            
            // Relasi ke Kategori
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');

            $table->text('description')->nullable();
            
            // Harga dan Stok Kritis
            $table->decimal('purchase_price', 15, 2); // Harga Beli
            $table->decimal('selling_price', 15, 2);  // Harga Jual
            $table->unsignedInteger('stock_current')->default(0); // Stok Saat Ini
            $table->unsignedInteger('stock_min')->default(10);    // Stok Minimum (untuk alert)
            $table->string('unit')->default('pcs'); // Unit (pcs, box, kg, dll)
            $table->string('rack_location')->nullable(); // Lokasi Rak di Gudang
            $table->string('image')->nullable(); // Gambar Produk
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
