<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
     protected $fillable = [
        'word_source',
        'word_target',
        'example_sentence',
        'contributor_id',
        'status',
    ];

    public function contributor()
    {
        return $this->belongsTo(User::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
