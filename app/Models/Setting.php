<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $fillable =
    [

        'field_id',
        'year_checking',
        'panel_checking',
        'panel_measurement',
        'month_period',
        'year',
        'start_month',
    ];
}
