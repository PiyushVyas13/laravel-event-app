<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Browse Events') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <!-- Repeat this block for each event -->
            @foreach($events as $event)
                @php
                    $start_time = date("g:i A", strtotime($event->start_time));
                    $end_time = date("g:i A", strtotime($event->end_time));
                    $date = date("d/m/Y", strtotime($event->date));
                @endphp
                <x-event-card
                    :id="$event->id"
                    :title="$event->name"
                    :date="$date"
                    :start_time="$start_time"
                    :end_time="$end_time"
                    :creator="$event->user->name"
                    :location="$event->location"
                />
            @endforeach
            <!-- Repeat this block for each event -->
        </div>
        @if(count($events) == 0)
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            {{ __("There are no events right now.") }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>


    {{$events->links()}}

</x-app-layout>
