<x-slot name="header">
    <div class="flex justify-between">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('No of questions:') }}
                
                <span>{{$assessment->total_questions}}</span>
            </h2>
            <h2 class="text-sm bg-green-200">Correct answers highlighted in green</h2>
        </div>
        <div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assessment Attempt:') }}
            <span>{{$attempt}}</span>
        </h2>
        </div>
    </div>
</x-slot>
<div>
    @foreach ($assessmentQuestions as $assessmentQuestion)
        <livewire:single-assessment-question-and-answers :assessmentQuestion="$assessmentQuestion"/>
    @endforeach
</div>