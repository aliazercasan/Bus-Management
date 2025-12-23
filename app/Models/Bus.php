<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $primaryKey = 'busID';
    public $incrementing = false;
    
    protected $fillable = [
        'busID',
        'route',
        'passengerCapacity',
        'passengerTotal',
        'routeTimeDate'
    ];

    protected $casts = [
        'routeTimeDate' => 'datetime',
    ];

    public function routeInfo()
    {
        return $this->belongsTo(Route::class, 'route', 'routeID');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'busID', 'busID');
    }
}
