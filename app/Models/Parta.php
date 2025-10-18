<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parta extends Model
{
    protected $fillable = [
        'story_id',
        'part_a_qs',
        'part_a_ans',
        'part_a_note'
    ];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }
}
