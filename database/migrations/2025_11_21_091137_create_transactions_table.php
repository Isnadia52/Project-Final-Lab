<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number')->unique(); // Nomor Transaksi (Auto-generated)
            $table->enum('type', ['incoming', 'outgoing']); // Tipe Transaksi
            $table->foreignId('staff_id')->constrained('users')->onDelete('cascade'); // Staff yang membuat
            
            // ID Customer/Supplier (sesuai type)
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onDelete('set null');
            $table->string('customer_name')->nullable(); // Jika Outgoing ke customer
            
            // Status Persetujuan
            $table->enum('status', ['Pending', 'Approved', 'Rejected', 'Completed'])->default('Pending');
            $table->foreignId('manager_id')->nullable()->constrained('users')->onDelete('set null'); // Manager yang menyetujui
            $table->timestamp('approval_date')->nullable(); // Tanggal Persetujuan
            
            $table->text('notes')->nullable();
            $table->date('transaction_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
