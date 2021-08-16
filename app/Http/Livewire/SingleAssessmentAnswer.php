<?php

namespace App\Http\Livewire;

use App\Models\Answer;
use App\Models\AssessmentQuestion;
use Livewire\Component;

class SingleAssessmentAnswer extends Component
{
    public $isCorrect = false;
    public $isEqual = false;
    public $answer;
    public $assessmentQuestion;

    public function mount(AssessmentQuestion $assessmentQuestion, Answer $answer)
    {
        $this->isCorrect = $answer->isCorrect == 'yes' ? true : false;
        $this->isEqual = $assessmentQuestion->answer_id == $answer->id ? true : false;
        $this->answer = $answer;
        $this->assessmentQuestion = $assessmentQuestion;
    }

    public function render()
    {
        return view('livewire.single-assessment-answer');
    }
}
