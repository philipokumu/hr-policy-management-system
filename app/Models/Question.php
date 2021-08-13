<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function correctAnswer()
    {
        return $this->hasOne(Answer::class)->where('isCorrect','yes');
    }

}
