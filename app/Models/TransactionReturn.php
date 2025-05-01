<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionReturn extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'user_id',
        'customer_id',
        'date',
        'reference_number',
        'total',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function details()
    {
        return $this->hasMany(TransactionReturnDetail::class, 'transaction_return_id');
    }
}
