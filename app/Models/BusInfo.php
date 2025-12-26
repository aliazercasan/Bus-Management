<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusInfo extends Model
{
    protected $fillable = [
        'busName',
        'engineNumber',
        'passengerCapacity',
    ];
}
