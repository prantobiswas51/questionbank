<?php

namespace App\Models;

use App\Helpers\WordTranslationHelper;
use Illuminate\Database\Eloquent\Model;

class Partc extends Model
{
    protected $fillable = [
        'story_id',
        'part_c_qs',
        'part_c_ans',
        'part_c_note'
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
            return $this->part_c_ans;
        }

        return WordTranslationHelper::wrapWordsWithTooltips($this->part_c_ans, $words);
    }
}
