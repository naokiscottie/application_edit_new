<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event_list extends Model
{
    use HasFactory;
    protected $table = 'event_lists';
    protected $fillable = [

        'event_name',
        'event_explanation',

    ];
}
