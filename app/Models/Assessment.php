<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function assessmentStats()
    {
        return $this->hasMany(AssessmentStat::class);
    }

    public function assessmentQuestions()
    {
        return $this->hasMany(AssessmentQuestion::class);
    }
}
