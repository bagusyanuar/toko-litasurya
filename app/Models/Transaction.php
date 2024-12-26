<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Menambahkan field baru pada $fillable
    protected $fillable = ['id', 'user_id', 'customer_id', 'reference_number', 'date', 'total', 'status'];

    // Mengubah tipe data id menjadi string (UUID)
    protected $casts = [
        'id' => 'string',
    ];

    // Relasi dengan Cart
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Relasi dengan Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
