<?php

namespace App\Models;

use App\Commons\Traits\Eloquent\Finder;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find($id)
 */
class Category extends Model
{
    use HasFactory, Uuids, Finder;

    protected $fillable = [
        'name',
        'image'
    ];
}
