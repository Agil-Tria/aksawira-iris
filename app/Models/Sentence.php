<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sentence extends Model
{
     protected $fillable = [
        'source_text',
        'target_text',
        'source_lang',
        'target_lang',
        'contributor_id',
        'status',
        'quality_level',
    ];

    public function contributor()
    {
        return $this->belongsTo(User::class, 'contributor_id');
    }

    public function validations()
    {
        return $this->hasMany(Validation::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
