<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'contact_number',
        'age',
        'address',
        'resume',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
