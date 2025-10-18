<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    protected $fillable = [
        'story_id',
        'summary_content'
    ];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }
}
