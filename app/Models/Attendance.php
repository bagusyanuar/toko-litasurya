<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'route_id',
        'date',
        'status',
        'reason',
        'image',
    ];

    /**
     * Relasi dengan model Route.
     */
    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }
}
