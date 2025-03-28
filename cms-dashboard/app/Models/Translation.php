<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $table = 'translation';
    public $timestamps = false;
    protected $fillable = [
        'table_name',
        'column_name',
        'row_id',
        'language_code',
        'translated_text',
       
    ];

}
