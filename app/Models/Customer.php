<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'type',
        'name',
        'phone',
        'address',
        'point'
    ];
}
