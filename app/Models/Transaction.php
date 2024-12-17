<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'customer_id', 'reference_number', 'date', 'total'];

    protected $casts = [
        'id' => 'string',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
