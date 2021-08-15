<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assessment Attempt') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="m-4">
                    <div class="mb-4">
                        Each question has its own timer. Pay attention to the timer as you answer the question. <br />

                    The assessment will take <b>{{$allocated_time}}</b> minutes.
                    </div>
                    <div>
                        <div class="flex flex-col md:flex-row">
                            <a href="{{route('assessment.show')}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-48">
                                Start Assessment
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
