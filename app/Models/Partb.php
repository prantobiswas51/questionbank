<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partb extends Model
{
    protected $fillable = [
        'story_id',
        'part_b_qs',
        'part_b_ans',
        'part_b_note'
    ];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }
}
