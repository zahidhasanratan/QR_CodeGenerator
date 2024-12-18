<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    // Define which fields can be mass-assigned
    protected $fillable = [
        'name',
        'email',
        'phone',
        'driver',
        'gender',
        'route',
        'description',
        'fare',
        'created_at',
        'updated_at'
    ];

    // Optional: Cast date fields to Carbon instances
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
