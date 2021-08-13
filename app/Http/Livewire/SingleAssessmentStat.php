<?php

namespace App\Http\Livewire;

use App\Models\AssessmentQuestion;
use App\Models\Question;
use App\Models\Topic;
use Livewire\Component;

class SingleAssessmentStat extends Component
{
    public $stat;
    public $topicName;
    public $averageAnsweringTime;

    public function mount()
    {
        $topic = Topic::find($this->stat->topic_id);
        $this->topicName = $topic->name;

        $assessmentQuestions_Ids = AssessmentQuestion::where(['assessment_id'=>$this->stat->assessment_id])->pluck('id');
        $questions_Ids = Question::where('topic_id',$topic->id)->whereIn('id',$assessmentQuestions_Ids)->pluck('id');
        $this->averageAnsweringTime = (int)AssessmentQuestion::whereIn('question_id',$questions_Ids)->avg('time_taken');

    }

    public function render()
    {
        return view('livewire.single-assessment-stat');
    }
}
