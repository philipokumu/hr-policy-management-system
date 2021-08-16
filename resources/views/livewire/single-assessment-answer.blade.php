<div x-data="{isCorrect: false, isEqual: false}" x-init="{isCorrect: @entangle('isCorrect'), isEqual : @entangle('isEqual')}">
    <label
        class="block mt-4 border border-gray-300 cursor-pointer rounded-lg py-2 px-6 text-base hover:bg-gray-100 focus:bg-green-200 {{ $isCorrect ? 'bg-green-200' : '' }}" >
        @if ($isEqual)
        <input type="radio" name="question-{{$assessmentQuestion->question_id}}" disabled checked value="{{$answer->id}}">
        @else
        <input type="radio" name="question-{{$assessmentQuestion->question_id}}" disabled value="{{$answer->id}}">
        @endif
        <span class="ml-6">{{$answer->answer_text}}</span>
    </label>
</div>
