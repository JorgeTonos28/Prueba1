<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $fillable = [
        'word',
        'syllables',
        'stress_index',
        'rhyme_key',
    ];
}
