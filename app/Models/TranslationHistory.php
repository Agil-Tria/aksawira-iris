<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TranslationHistory extends Model
{
     protected $fillable = [
        'user_id',
        'input_text',
        'translated_text',
        'direction',
    ];
}
