<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection_panel_checking extends Model
{
    use HasFactory;
    protected $table = 'inspection_panel_checkings';
    protected $fillable =
    [

        'field_id',
        'times',
        'status',

    ];
}
