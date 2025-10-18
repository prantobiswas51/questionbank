<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
     protected $fillable = [
        'paper_id',
        'story_name',
        'story_type',        
    ];

    public function paper()
    {
        return $this->belongsTo(Paper::class);
    }
}
