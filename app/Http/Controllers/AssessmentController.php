<?php

namespace App\Http\Controllers;

use App\Models\AssessmentQuestion;
use App\Models\Question;
use App\Models\Topic;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function create()
    {
        //Create test
        $assessment = request()->user()->assessments()->create();

        $topics = Topic::all();

        // Foreach topic pick random questions
        foreach($topics as $topic) {
            $questions = Question::where('topic_id',$topic->id)->get()->random(3);
            // Create records for above questions and link to above test
            foreach ($questions as $question) {
                $question->assessmentQuestions()->create([
                    'assessment_id'=>$assessment->id,
                ]);
            }
        }
        
        //Sum up the total questions count for use in actual assessment
        $assessment->update(['total_questions'=>$assessment->assessmentQuestions()->count()]);

        $questionIds = $assessment->assessmentQuestions()->pluck('question_id');
        $allocated_time = Question::whereIn('id',$questionIds)->sum('allocated_time')/60;

        // Return to view with intro before questions
        return view('pages.assessments.intro', compact('assessment','allocated_time'));
    }

}
