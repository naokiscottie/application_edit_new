<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection_panel_measurement extends Model
{
    use HasFactory;
    protected $table = 'inspection_panel_measurements';
    protected $fillable =
    [

        'field_id',
        'status',

    ];
}
