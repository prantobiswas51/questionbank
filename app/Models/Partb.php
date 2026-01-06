<?php

namespace App\Models;

use App\Helpers\WordTranslationHelper;
use Illuminate\Database\Eloquent\Model;

class Partb extends Model
{
    protected $fillable = [
        'story_id',
        'part_b_qs',
        'part_b_ans',
        'part_b_note'
    ];

    protected $appends = ['translated_answer'];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function getTranslatedAnswerAttribute()
    {
        $words = Word::all();
        
        if ($words->isEmpty()) {
            return $this->part_b_ans;
        }

        return WordTranslationHelper::wrapWordsWithTooltips($this->part_b_ans, $words);
    }
}
