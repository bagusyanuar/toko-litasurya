<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find($id)
 */
class Reward extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'name',
        'image',
        'point'
    ];
}
