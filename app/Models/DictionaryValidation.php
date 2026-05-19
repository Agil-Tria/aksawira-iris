<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DictionaryValidation extends Model
{
     protected $fillable = [
        'dictionary_id',
        'validator_id',
        'action',
        'notes',
    ];

    public function dictionary()
    {
        return $this->belongsTo(Dictionary::class);
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validator_id');
    }
}
