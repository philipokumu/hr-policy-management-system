<?php

namespace App\Http\Livewire;

use App\Models\AssessmentQuestion;
use App\Models\AssessmentStat;
use App\Models\Question;
use App\Models\Topic;
use Livewire\Component;

class SingleAssessmentStat extends Component
{
    public $stat;
    public $topicName;
    public $averageAnsweringTime;

    public function mount(AssessmentStat $stat)
    {
        $this->stat = $stat;
        $topic = Topic::find($stat->topic_id);
        $this->topicName = $topic->name;

        $questions_Ids = AssessmentQuestion::where(['assessment_id'=>$stat->assessment_id])->pluck('question_id');
        $topicQuestions_Ids = Question::where('topic_id',$topic->id)->whereIn('id',$questions_Ids)->pluck('id');
        $this->averageAnsweringTime = (int)AssessmentQuestion::where(['assessment_id'=>$stat->assessment_id])->whereIn('question_id',$topicQuestions_Ids)->avg('time_taken');

    }

    public function render()
    {
        return view('livewire.single-assessment-stat');
    }
}
