<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    protected $fillable = [
        'sentence_id',
        'validator_id',
        'action',
        'notes',
    ];

    public function sentence()
    {
        return $this->belongsTo(Sentence::class);
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validator_id');
    }
}
