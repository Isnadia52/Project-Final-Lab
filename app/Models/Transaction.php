<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_number', 'type', 'staff_id', 'supplier_id', 
        'customer_name', 'status', 'manager_id', 'approval_date', 'notes', 
        'transaction_date'
    ];

    // Relasi 1:N (Transaksi memiliki banyak item produk)
    public function items(): HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }

    // Relasi N:1 (Transaksi dibuat oleh satu Staff)
    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    // Relasi N:1 (Transaksi disetujui oleh satu Manager)
    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    // Relasi N:1 (Jika Incoming, terhubung ke Supplier)
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
