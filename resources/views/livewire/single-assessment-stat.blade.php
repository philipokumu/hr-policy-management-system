<div>
    <div class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
        <div class="flex items-start justify-between">
            <div class="flex flex-col space-y-2">
            <span class="text-gray-500">{{$topicName}} performance</span>
            <span class="text-lg font-semibold {{ $stat->topic_performance < 51 ? 'text-red-500' : '' }}">{{$stat->topic_performance}}%</span>
            </div>
        </div>
        <div>
            @if ($averageAnsweringTime >= 1 && $averageAnsweringTime <= 10)
            <span class="inline-block px-2 text-sm text-white bg-red-400 rounded ">{{$averageAnsweringTime}} secs</span>
            @endif
            @if ($averageAnsweringTime >= 11 && $averageAnsweringTime <= 29)
            <span class="inline-block px-2 text-sm text-white bg-green-300 rounded ">{{$averageAnsweringTime}} secs</span>
            @endif
            @if ($averageAnsweringTime >= 30  && $averageAnsweringTime <= 40)
            <span class="inline-block px-2 text-sm text-white bg-red-600 rounded ">{{$averageAnsweringTime}} secs</span>
            @endif
            <span>Avg answer speed</span>
        </div>
    </div>
</div>
