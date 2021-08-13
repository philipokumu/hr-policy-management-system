<?php

namespace App\Http\Controllers;

use App\Models\AssessmentQuestion;
use App\Models\Question;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function create()
    {
        //Create test
        $assessment = request()->user()->assessments()->create([
            'total_questions' => 10
        ]);

        // Pick questions
        $questions = Question::all();
        // $questions = Question::all()->random(10);

        // Create records for above questions and link to above test
        foreach ($questions as $question) {
            $question->assessment_questions()->create([
                'assessment_id'=>$assessment->id,
            ]);
        }

        // Pull all questions for this test
        $assessmentQuestions = AssessmentQuestion::where('assessment_id',$assessment->id)->inRandomOrder()->get();

        // Return to view with the questions
        return view('assessments.create', compact('assessmentQuestions'));
    }
}
