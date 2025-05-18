<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionReturnDetail extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'transaction_return_id',
        'item_id',
        'qty',
        'price',
        'unit',
        'total',
    ];

    public function transaction_return()
    {
        return $this->belongsTo(TransactionReturn::class, 'transaction_return_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
