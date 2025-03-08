<?php

namespace App\Models;

use App\Commons\Traits\Eloquent\Finder;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'user_id',
        'customer_id',
        'reference_number',
        'date',
        'total',
        'status',
        'type'
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'transaction_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

}
