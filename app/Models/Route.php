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

    protected $appends = [
        'store_string'
    ];

    public function details()
    {
        return $this->hasMany(RouteDetail::class, 'route_id');
    }

    public function getStoreStringAttribute()
    {
        $details = $this->details;
        $result = '';
        foreach ($details as $idx => $detail) {
            if ($idx === $details->keys()->last()) {
                $result .= "{$detail->customer->name}";
            } else {
                $result .= "{$detail->customer->name}, ";
            }
        }
        return $result;
    }
}
