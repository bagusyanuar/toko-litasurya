<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $casts = [
        'id' => 'string',
    ];

    protected $fillable = [
        'id',
        'type',
        'name',
        'phone',
        'address',
        'point',
    ];
}
