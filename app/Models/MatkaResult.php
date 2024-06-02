<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatkaResult extends Model
{
    use HasFactory;
    protected $fillable = [
        'market_id',
        'market_name',
        'aankdo_date',
        'aankdo_open',
        'aankdo_close',
        'figure_open',
        'figure_close',
        'jodi',
        'updated_at'
    ];
}
