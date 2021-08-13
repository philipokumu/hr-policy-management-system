<div>
    <x-slot name="header">
        <div class="flex md:justify-between flex-col md:flex-row">
            <div class="flex items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Your performance') }}
                </h2>
            </div>
            <div class="flex flex-col md:flex-row">
                <a href="{{route('assessment.create')}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-48">
                    {{$assessmentCount < 1 ? 'Start Assessment' : 'Retake Assessment'}}
                </a>
            </div>
        </div>
    </x-slot>
    @if ($assessmentCount > 0)
    <div class="py-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <div class="bg-white p-6 rounded shadow mt-4">
                  <h3 class="mb-3 text-xl">Aggregate performance</h3>
                  <h3 class="text-xl {{ $aggregatePerformance < 51 ? 'text-red-500' : '' }}">{{$aggregatePerformance}}%</h3>
                  <div>
                      @if ($aggregateAnsweringTime >= 1 && $aggregateAnsweringTime <= 10)
                      <span class="inline-block px-2 text-sm text-white bg-red-400 rounded ">{{$aggregateAnsweringTime}} secs</span>
                      @endif
                      @if ($aggregateAnsweringTime >= 11 && $aggregateAnsweringTime <= 29)
                      <span class="inline-block px-2 text-sm text-white bg-green-300 rounded ">{{$aggregateAnsweringTime}} secs</span>
                      @endif
                      @if ($aggregateAnsweringTime >= 30  && $aggregateAnsweringTime <= 40)
                      <span class="inline-block px-2 text-sm text-white bg-red-600 rounded ">{{$aggregateAnsweringTime}} secs</span>
                      @endif
                      <span>Avg answer speed</span>
                  </div>
              </div>


              <div class="bg-white p-4 rounded shadow mt-4">
                  <h3 class="text-xl">Performance by topic</h3>
                  @if ($assessmentCount > 0)
                  <div class="grid grid-cols-1 gap-5 mt-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($assessmentStats as $stat)
                    <livewire:single-assessment-stat :stat="$stat"/>
                    @endforeach
                </div>
                  @endif
              </div>


              <div class="m-3">
                  <h3 class="mt-6 text-xl">The policy documents</h3>
              <h5 class="mt-4 text-base">Read the following company documents before retaking the assessment (Click to open)</h5>
              </div>
              <div class="flex flex-col mt-6">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden border-b border-gray-200 rounded-md shadow-md">
                      <table class="min-w-full overflow-x-scroll divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                          <tr>
                            <th
                              scope="col"
                              class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                            >
                              Document Name
                            </th>
                            <th
                              scope="col"
                              class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase"
                            >
                              Topic to revisit
                            </th>
                          </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                          @if ($assessmentCount > 0)
                          @foreach ($topicIds as $topicId)
                          <livewire:single-policy-document :topicId="$topicId"/>
                          @endforeach
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
          </div>
      </div>
  </div>
  @else
  <div class="min-h-screen bg-gray-200 flex items-center justify-center">
    <span class="text-gray-500 font-extrabold text-3xl">
      No statistics yet
    </span>
  </div>
  @endif
  </div>
