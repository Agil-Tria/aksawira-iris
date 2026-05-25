<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DictionaryEntry extends Model
{
    protected $fillable = [

    'lemma',

    'meaning',

    'dialect',

    'word_class',

    'phonetic',

    'is_sublemma',

    'parent_lemma',

    'homonym_no',

    'morphology_raw',

    'status',

    'contributor_id',

    ];

    public function examples()
    {
        return $this->hasMany(
            DictionaryExample::class
        );
    }

    public function parentLemma()
    {
        return $this->belongsTo(
            DictionaryEntry::class,
            'parent_lemma_id'
        );
    }

    public function sublemmas()
    {
        return $this->hasMany(
            DictionaryEntry::class,
            'parent_lemma_id'
        );
    }
}
