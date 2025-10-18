<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
     protected $fillable = [
        'subject_id',
        'paper_name',
        'paper_code'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
