<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentStat extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function topic()
    {
        return $this->hasOne(Topic::class);
    }
}
