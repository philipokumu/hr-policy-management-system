<?php

namespace App\Http\Livewire;

use App\Models\Assessment;
use Livewire\Component;

class ShowAssessment extends Component
{
    public $totalQuestions;
    public $currentQuestionNumber;
    public $assessment;

    public function mount()
    {
        $this->assessment = Assessment::where(['user_id'=>request()->user()->id,'isComplete'=>'no'])->first();
    }

    public function render()
    {
        return view('livewire.show-assessment');
    }
}
