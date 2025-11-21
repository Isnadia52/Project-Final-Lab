<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    // Relasi 1:N (Satu Kategori memiliki banyak Produk)
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
