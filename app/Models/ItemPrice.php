<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemPrice extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'item_id',
        'price_list_unit',
        'price',
        'unit',
        'description'
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class,'item_id');
    }
}
