<div>
    <div class="bg-white p-12 rounded-lg shadow-lg w-full mt-8">
        <p class="text-xl font-bold">
            {{$question->question_text}}
        </p>
        @foreach ($answers as $answer)
        <livewire:single-assessment-answer :assessmentQuestion="$assessmentQuestion" :answer="$answer"/>
        @endforeach
    </div>
</div>
