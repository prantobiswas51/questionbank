<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partc extends Model
{
    protected $fillable = [
        'story_id',
        'part_c_qs',
        'part_c_ans',
        'part_c_note'
    ];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }
}
