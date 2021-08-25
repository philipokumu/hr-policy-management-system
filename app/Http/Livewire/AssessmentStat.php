<?php

namespace App\Http\Livewire;

use App\Models\Assessment;
use App\Models\AssessmentQuestion;
use App\Models\AssessmentStat as ModelsAssessmentStat;
use App\Models\TopicDocument;
use App\Models\User;
use Livewire\Component;

class AssessmentStat extends Component
{
    public $user;
    public $attempts;
    public $topicIds;
    public $isAdminStats;
    public $assessment;
    public $assessmentCount;
    public $assessmentStats;
    public $aggregatePerformance;
    public $aggregateAnsweringTime;

    public function mount(User $user)
    {

        // Check if its normal user or admin accessing this page
        if (auth()->user()->role !='admin') {

            $assessment = Assessment::where(['user_id'=>request()->user()->id,'isComplete'=>'yes'])->orderby('created_at', 'desc')->first();
            
        }
        else {

            $assessment = Assessment::where(['user_id'=>$user->id,'isComplete'=>'yes'])->orderby('created_at', 'desc')->first();
            $this->user = $user;
            $assessment_Ids = Assessment::where('user_id',$user->id)->pluck('id');
            $this->attempts = ModelsAssessmentStat::whereIn('assessment_id',$assessment_Ids)->count();

        }

        $this->isAdminStats = $user->id ==request()->user()->id ? 'yes' : 'no';

        $this->assessmentCount = $assessment ? 1 : 0;
        
        if ($assessment) {
            $this->assessment = $assessment;
            $assessmentStats = ModelsAssessmentStat::where([
            'assessment_id'=> $assessment->id,
            ])->get();

            
            $this->aggregatePerformance = round($assessmentStats->avg('topic_performance'));
            
            $this->topicIds = ModelsAssessmentStat::where(['assessment_id'=> $assessment->id,'should_recap_topic'=>'yes'])->pluck('topic_id');
    
            $this->assessmentStats = $assessmentStats;
    
            $this->aggregateAnsweringTime = (int)AssessmentQuestion::where('assessment_id',$assessment->id)->avg('time_taken');
            // dd($assessment->assessmentQuestions()->pluck('id'));
        }

    }

    public function render()
    {
        return view('livewire.assessment-stat');
    }
}
