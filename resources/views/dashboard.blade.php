<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(auth()->user()->role !='admin')
                {{ __('My Dashboard') }}
                @else
                
                <div class="m-4">
                {{ __('All staff members') }}
                <h2 class="text-sm">
                    
                    {{ __('Click record to view the staff members policy performance') }}
                </h2>
            </div>
            @endif
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                @if(auth()->user()->role !='admin')
                <livewire:assessment-stat />
                @else
                
                <div class="m-4">
                    <livewire:user-table />
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
