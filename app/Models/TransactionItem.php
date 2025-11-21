<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionItem extends Model
{
    // Ini adalah pivot table, tapi karena punya ID sendiri, bisa pakai Model biasa
    protected $table = 'transaction_items';
    public $timestamps = false;
    protected $fillable = ['transaction_id', 'product_id', 'quantity'];

    // Relasi N:1 (Item ini adalah bagian dari satu Transaksi)
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    // Relasi N:1 (Item ini merujuk ke satu Produk)
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
