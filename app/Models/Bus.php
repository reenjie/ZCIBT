<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'Bus_No',
        'seating_capacity',
        'company',
        'weight',
        'color',
        'per_column',
        'per_row'
    ];
}
