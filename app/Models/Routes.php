<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routes extends Model
{
    use HasFactory;

    protected $fillable = [
        'lng',
        'lat',
        'from',
        'to',
        'aircon_fare',
        'non_aircon_fare',
      

    ];
}
