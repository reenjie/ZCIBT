<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel_schedule extends Model
{
    use HasFactory;

    protected $fillable=[
        'departure',
        'est_arrival',
        'schedule',
        'est_traveltime',
        'remarks',
        'status'
    ];
}
