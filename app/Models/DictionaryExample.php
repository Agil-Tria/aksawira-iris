<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DictionaryExample extends Model
{
     protected $fillable = [

        'dictionary_entry_id',

        'example_source',

        'example_target'

    ];

    public function entry()
    {
        return $this->belongsTo(
            DictionaryEntry::class,
        );
    }
}
