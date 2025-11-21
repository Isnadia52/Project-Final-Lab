<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // PENTING: izinkan pengisian role
        'is_approved', // PENTING: izinkan pengisian status persetujuan
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    // ======================================
    // LOGIKA RELASI
    // ======================================

    // User sebagai Staff Gudang (Membuat banyak transaksi)
    public function createdTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'staff_id');
    }

    // User sebagai Manager (Menyetujui banyak transaksi)
    public function approvedTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'manager_id');
    }
    
    // User sebagai Supplier (Punya satu data supplier)
    public function supplierData(): HasOne
    {
        return $this->hasOne(Supplier::class);
    }
}