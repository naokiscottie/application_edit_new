<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection_year_checking extends Model
{
    use HasFactory;
    protected $table = 'inspection_year_checkings';
    protected $fillable =
    [

        'field_id',
        'status',

    ];
}
