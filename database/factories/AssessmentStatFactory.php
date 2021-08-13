<?php

namespace Database\Factories;

use App\Models\AssessmentStat;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssessmentStatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AssessmentStat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'topic_employee_score' => 2,
            'topic_total_questions' => 4
        ];
    }
}
