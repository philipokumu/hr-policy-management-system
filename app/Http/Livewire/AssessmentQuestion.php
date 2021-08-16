<?php

namespace App\Http\Livewire;

use App\Models\Answer;
use App\Models\Assessment;
use App\Models\AssessmentQuestion as ModelsAssessmentQuestion;
use App\Models\AssessmentStat;
use App\Models\Question;
use App\Models\Topic;
use Livewire\Component;

class AssessmentQuestion extends Component
{
    public $assessment;
    public $unansweredQuestionsCount;
    public $currentAssessmentQuestion;
    public $currentQuestion;
    public $allocatedTime;
    public $currentAnswers;
    public $answer_id;
    public $time_taken = 0;
    public $topic;

    protected $rules = [
        'answer_id' => 'sometimes',
        'time_taken' => 'required',
    ];

    public function mount(Assessment $assessment)
    {
        $this->assessment = $assessment;

        $this->unansweredQuestionsCount = $assessment->total_questions - $assessment->assessmentQuestions()->where([
            'assessment_id'=>$assessment->id,
            'isCompleted'=>'no'
        ])->count() + 1;

        $currentAssessmentQuestion = ModelsAssessmentQuestion::where([
            'assessment_id'=>$assessment->id,
            'isCompleted'=>'no'
        ])->inRandomOrder()->first();

        if ($currentAssessmentQuestion) {

            $this->currentAssessmentQuestion = $currentAssessmentQuestion;

            $this->currentQuestion = Question::find($currentAssessmentQuestion->question_id);
            $this->allocatedTime = $this->currentQuestion->allocated_time;
            $this->topic = Topic::find($this->currentQuestion->topic_id);
            $this->currentAnswers = Answer::where('question_id',$this->currentQuestion->id)->inRandomOrder()->get();
        }

        else {

            $this->assessment->update(['isComplete'=>'yes']);

            $assessmentStats = AssessmentStat::where('assessment_id',$assessment->id)->get();

            foreach( $assessmentStats as $stat) {

                $topicPerformance = round(($stat->topic_employee_score/$stat->topic_total_questions * 100),1); 

                $should_recap_topic = $topicPerformance > 50 ? 'no' : 'yes';

                $stat->update(['should_recap_topic'=>$should_recap_topic, 'topic_performance'=> $topicPerformance]);

                auth()->user()->role=='normal'
                    ? redirect(route('dashboard'))
                    : redirect(route('user.assessment.stat',auth()->user()));
                
            }
        }
        
    }

    public function update() 
    {   
        $this->validate();

        $answerScore = 0;

        if ($this->answer_id != null) {

            $this->currentAssessmentQuestion->update([
                'answer_id'=>$this->answer_id,
                'time_taken'=>$this->time_taken,
                'isCompleted'=>'yes',
            ]);

            $answerScore = Answer::find($this->answer_id)->isCorrect == 'yes' ? 1 : 0;

        } else {
            
            $this->currentAssessmentQuestion->update(['isCompleted'=>'yes','time_taken'=>$this->time_taken]);

            $answerScore = 0;
        }

        //Update stat table for this assessment and topic
        $assessmentStat = AssessmentStat::where([
            'assessment_id'=>$this->assessment->id,
            'topic_id'=>$this->topic->id])->first();

        //Create or update topic stat based on if it exists or not
        if ($assessmentStat) {
            $assessmentStat->update([
                'topic_employee_score'=>$assessmentStat->topic_employee_score + $answerScore,
                'topic_total_questions'=> $assessmentStat->topic_total_questions + 1]);
        }
        else {
            $this->assessment->assessmentStats()->create([
                'topic_id'=>$this->topic->id,
                'topic_employee_score'=>$answerScore,
                'topic_total_questions'=> 1
            ]);
        }

        return redirect(route('assessment.show'));

    }





    public function render()
    {
        return view('livewire.assessment-question');
    }

    
}
