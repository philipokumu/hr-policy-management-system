<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\AssessmentQuestion;
use App\Models\AssessmentStat;
use App\Models\Question;
use App\Models\Topic;
use Illuminate\Http\Request;

class AssessmentQuestionController extends Controller
{
    public function update(Assessment $assessment, AssessmentQuestion $assessmentQuestion)
    {
        $data = request()->validate([
            'answer_id'=>'sometimes',
            'time_taken'=>'',
            'isLast'=>'sometimes'
        ]);

        if ($data['answer_id']) {

            $assessmentQuestion->update(['answer_id'=>$data['answer_id'],'time_taken'=>$data['time_taken']]);

            // For creating or updating the stat record
            $question = Question::where('id',$assessmentQuestion->id)->firstOrFail();

                //Answerscore
            $answer = $question->correctAnswer;

            $answerScore = $answer->id == $data['answer_id'] ? 1 : 0;

            $topic = Topic::where('id',$question->topic_id)->firstOrFail();

            $assessmentStat = AssessmentStat::where([
                'assessment_id'=>$assessment->id,
                'topic_id'=>$topic->id])->first();

            //Create or update stat based on if it exists or not
            if ($assessmentStat) {
                $assessmentStat->update([
                    'topic_employee_score'=>$assessmentStat->topic_employee_score + $answerScore,
                    'topic_total_questions'=> $assessmentStat->topic_total_questions + 1]);
            }
            else {
                $assessment->assessmentStats()->create([
                    'topic_id'=>$topic->id,
                    'topic_employee_score'=>$answerScore,
                    'topic_total_questions'=> 1
                ]);
            }
        }

        // If its the last question, rate employee's performance per topic
        if ($data['isLast'] == 'yes') {

            $assessmentStats = AssessmentStat::where('assessment_id',$assessment->id)->get();

            foreach( $assessmentStats as $stat) {

                $topicPerformance = $stat->topic_employee_score/$stat->topic_total_questions * 100; 

                $should_recap_topic = $topicPerformance > 50 ? 'yes' : 'no';

                $stat->update(['should_recap_topic'=>$should_recap_topic, 'topic_performance'=> $topicPerformance]);
            }

            // return;
        }


        // return;
    }
}
