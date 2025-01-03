<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    // Setel tipe id sebagai string
    protected $keyType = 'string';

    // Secara default, Laravel akan menyimpan 'id' sebagai UUID jika fieldnya UUID di database
    protected $primaryKey = 'id';

    protected $fillable = [
        'sales_id',
        'customer_id',
        'day_of_week',
        'repeat',
    ];

    /**
     * Relasi dengan model Sales.
     */
    public function sales()
    {
        return $this->belongsTo(Sales::class, 'sales_id');
    }


    /**
     * Relasi dengan model Sales.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Relasi dengan model Attendance.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'route_id');
    }
}
