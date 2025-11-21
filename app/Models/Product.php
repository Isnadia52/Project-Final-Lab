<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'sku', 'name', 'category_id', 'description', 'purchase_price', 
        'selling_price', 'stock_current', 'stock_min', 'unit', 'rack_location', 'image'
    ];

    // Relasi 1:N (Produk dimiliki oleh satu Kategori)
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi 1:N (Produk ada di banyak item transaksi)
    public function transactionItems(): HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }
    
    // (Akan ditambahkan relasi Restock Order nanti)
}