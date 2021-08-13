<?php

namespace App\Http\Livewire;

use App\Models\Assessment;
use App\Models\AssessmentQuestion;
use App\Models\AssessmentStat as ModelsAssessmentStat;
use App\Models\TopicDocument;
use Livewire\Component;

class AssessmentStat extends Component
{
    public $topicIds;
    public $assessmentCount;
    public $assessmentStats;
    public $aggregatePerformance;
    public $aggregateAnsweringTime;

    public function mount()
    {
        $assessment = Assessment::where('user_id',request()->user()->id)->orderby('created_at', 'desc')->first();

        $this->assessmentCount = $assessment ? 1 : 0;
        
        if ($assessment) {

            $assessmentStats = ModelsAssessmentStat::where([
            'assessment_id'=> $assessment->id,
            ])->get();
            
            $this->aggregatePerformance = $assessmentStats->avg('topic_performance');
            
            $this->topicIds = $assessmentStats->pluck('topic_id')->toArray();
    
            $this->assessmentStats = $assessmentStats;
    
            $this->aggregateAnsweringTime = (int)AssessmentQuestion::where('assessment_id',$assessment->id)->avg('time_taken');
    }

    }

    public function render()
    {
        return view('livewire.assessment-stat');
    }
}
