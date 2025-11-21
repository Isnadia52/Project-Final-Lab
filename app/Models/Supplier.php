<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'user_id'
    ];

    // ======================================
    // LOGIKA RELASI
    // ======================================
    
    /**
     * Relasi N:1 ke User
     * Menghubungkan data Supplier ini ke akun login di tabel users (1:1)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Relasi 1:N ke Transaction (Barang Masuk)
     * Supplier menerima banyak Transaksi Masuk (sebagai referensi)
     */
    public function incomingTransactions(): HasMany
    {
        // Transaksi tipe 'incoming' merujuk ke supplier ini
        return $this->hasMany(Transaction::class); 
    }

    /**
     * Relasi 1:N ke Restock Orders
     * Supplier menerima banyak Pesanan Restock
     */
    public function restockOrders(): HasMany
    {
        return $this->hasMany(RestockOrder::class);
    }
}
