<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection_month_checking extends Model
{
    use HasFactory;
    protected $table = 'inspection_month_checkings';
    protected $fillable =
    [

        'field_id',
        'times',
        'status',

    ];
}
