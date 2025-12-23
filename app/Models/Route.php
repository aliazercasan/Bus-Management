<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $primaryKey = 'routeID';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'routeID',
        'routeFrom',
        'routeTo',
        'oras'
    ];

    public function buses()
    {
        return $this->hasMany(Bus::class, 'route', 'routeID');
    }
}
