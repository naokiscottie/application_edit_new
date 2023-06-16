<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $table = 'documents';
    protected $fillable = [

        'file_name',
        'document_name',
        'field_id',
        'document_id',
        'document_remarks',

    ];
}
