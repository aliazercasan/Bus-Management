<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
        'routeFrom',
        'routeTo',
        'oras'
    ];

    public function buses()
    {
        return $this->hasMany(Bus::class, 'route', 'id');
    }
}
