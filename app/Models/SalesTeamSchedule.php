<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesTeamSchedule extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'sales_team_id',
        'route_id',
        'day',
    ];

    public function sales_team()
    {
        return $this->belongsTo(SalesTeam::class, 'sales_team_id');
    }

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }
}
