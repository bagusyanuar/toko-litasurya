<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesTeamVisit extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'sales_team_id',
        'store_id',
        'visited_at',
        'image',
        'status',
        'description'
    ];

    public function sales()
    {
        return $this->belongsTo(SalesTeam::class, 'sales_team_id');
    }

    public function store()
    {
        return $this->belongsTo(Customer::class, 'store_id');
    }
}
