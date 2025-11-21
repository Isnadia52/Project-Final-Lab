<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Ini akan menambahkan kolom ke tabel 'users' yang SUDAH ADA.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            
            // Kolom 1: ROLE (Peran)
            // Tipe data ENUM hanya bisa menyimpan salah satu dari 4 peran ini.
            $table->enum('role', ['Admin', 'Manager', 'Staff Gudang', 'Supplier'])
                  ->default('Staff Gudang')
                  ->after('password'); // Diletakkan setelah kolom 'password'
            
            // Kolom 2: IS_APPROVED (Status Persetujuan Supplier)
            // Boolean: 1 (Approved) atau 0 (Pending/Rejected).
            // Kita set default 1 agar pengguna lain (Admin/Manager/Staff) langsung aktif.
            $table->boolean('is_approved')
                  ->default(1) 
                  ->after('role'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Jika rollback, hapus kedua kolom tersebut.
            $table->dropColumn(['role', 'is_approved']);
        });
    }
};
