<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Item extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'category_id',
        'name',
        'image',
        'description'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function prices(): HasMany
    {
        return $this->hasMany(ItemPrice::class, 'item_id');
    }

    public function retail_price(): HasOne
    {
        return $this->hasOne(ItemPrice::class, 'item_id')
            ->where('unit', '=', 'retail');
    }
}
