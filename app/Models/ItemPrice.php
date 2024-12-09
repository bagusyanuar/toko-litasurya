<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'unit',
        'price',
        'description'
    ];

    /**
     * Relasi ke tabel items.
     * Satu harga terkait dengan satu item (BelongsTo).
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
