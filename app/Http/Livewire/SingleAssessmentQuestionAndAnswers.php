<?php

namespace App\Http\Livewire;

use App\Models\AssessmentQuestion;
use App\Models\Question;
use Livewire\Component;

class SingleAssessmentQuestionAndAnswers extends Component
{
    public $question;
    public $answers;
    public $assessmentQuestion;

    public function mount(AssessmentQuestion $assessmentQuestion)
    {
        $this->question = Question::find($assessmentQuestion->question_id);

        $this->answers = $this->question->answers;
        
        $this->assessmentQuestion = $assessmentQuestion;

    }

    public function render()
    {
        return view('livewire.single-assessment-question-and-answers');
    }
}
