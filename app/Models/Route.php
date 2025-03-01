<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'name'
    ];

    public function details()
    {
        return $this->hasMany(RouteDetail::class,'route_id');
    }
}
