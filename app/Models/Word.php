<?php

namespace App\Models;

use App\Models\Story;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    public $fillable = [
        'story_id',
        'english_word',
        'meaning',
        'notes'
    ];

      public function story()
    {
        return $this->belongsTo(Story::class);
    }
}
