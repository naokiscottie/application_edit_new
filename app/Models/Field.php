<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $table = 'fields';
    protected $fillable = [
        'field_name',
        'field_address',
        'power',
        'solar_power',
        'contract_date',
        'contract_money',
        'customer_id',
    ];


}
