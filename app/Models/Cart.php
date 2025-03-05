<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'user_id',
        'transaction_id',
        'customer_id',
        'item_id',
        'request_qty',
        'qty',
        'price',
        'unit',
        'total',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
