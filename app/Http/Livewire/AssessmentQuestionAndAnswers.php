<?php

namespace App\Http\Livewire;

use App\Models\Assessment;
use App\Models\User;
use Livewire\Component;

class AssessmentQuestionAndAnswers extends Component
{
    public $assessmentQuestions;
    public $assessment;
    public $attempt;

    public function mount(User $user, Assessment $assessment)
    {
        $this->assessment = $assessment;
        $this->attempt = $user->assessments()->count();

        $this->assessmentQuestions = $assessment->assessmentQuestions;
    }

    public function render()
    {
        return view('livewire.assessment-question-and-answers');
    }
}
