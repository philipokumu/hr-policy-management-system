    <div x-data="countDown()" x-init="init()">
        <h3 class="text-red-500 text-center" x-bind:class="{ 'hidden': getTime() != 0 }"><b>Time is up! Move on to the next question.</b></h3>
        <form wire:submit.prevent="update" method="POST">
            <h2>{{$unansweredQuestionsCount}} of {{$assessment->total_questions}}</h2>
            <h1 class="font-bold text-xl text-gray-700 text-right" x-text="getTime() + ':00'">
            </h1>
            <input type="text" hidden aria-hidden="true" disabled name="time_taken" wire:model="time_taken" x-model="time_taken">
            <div class="bg-white p-12 rounded-lg shadow-lg w-full mt-8">
                    <p class="text-2xl font-bold">
                        {{$currentQuestion->question_text}}
                    </p>
                    @foreach ($currentAnswers as $answer)
                    <label
                        class="block mt-4 border border-gray-300 cursor-pointer rounded-lg py-2 px-6 text-lg hover:bg-gray-100 focus:bg-green-200">
                        <input type="radio" name="answer" wire:model='answer_id' value="{{$answer->id}}" x-bind:disabled='getTime() == 0'>
                        <span class="ml-6">{{$answer->answer_text}}</span>
                    </label>
                    @endforeach
                    <div class="mt-6 flow-root">
                        <button
                            class="float-right bg-indigo-600 text-white text-sm font-bold tracking-wide rounded-full px-5 py-2" type="submit">
                            @if($unansweredQuestionsCount != $assessment->total_questions)
                            Next
                            @else
                            Submit
                            @endif
                        </button>
                    </div>
                </div>
            </form>
        </div>
<script>
    function countDown() {
        return {
            countdown: 0,
            time_taken: @entangle('time_taken'),
            init() {
                this.countdown = {{$allocatedTime}}
                setInterval(() => {
                if (this.countdown > 0) {
                    this.countdown = this.countdown-0.5;
                    this.time_taken = {{$allocatedTime}} - this.countdown
                }
              }, 1000);
            },
            getTime() {
                return this.countdown
                
            },
        }
    } 

</script>
