<?php

namespace Database\Factories;

use App\Models\AssessmentQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssessmentQuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AssessmentQuestion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'assessment_id'=>1,
            'question_id'=>1,
        ];
    }
}
