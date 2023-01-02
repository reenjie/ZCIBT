<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Column_seats extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_id',
        'column',
        'rowseat_id',
        'seatnumber'

    ];
}
