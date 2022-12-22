<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_id',
        'column_seat_id',
        'row_seat_id',
        'routes_id',
        'ts_id',
        'user_id',
        'discount',
        'idfile',
        'status',
        'reason',
        'exp_date'

    ];
}
