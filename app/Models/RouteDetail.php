<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteDetail extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'route_id',
        'customer_id'
    ];

    protected $with = [
        'customer'
    ];

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
