<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Your Events') }}
            </h2>

            <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'First')">{{__('Create Event')}}</x-primary-button>
        </div>
    </x-slot>
    <x-modal name="First" :show="$errors->isNotEmpty()" focusable>
        <div class="flex flex-col gap-4 p-4">
            <div class="text-start">
                <div class="text-2xl font-bold dark:text-gray-100">
                    {{__('Create Event')}}
                </div>
                <div class="font-light text-gray-300 mt-2">
                    {{__('Enter event details')}}
                </div>
            </div>
            <form method="post" action="{{route('events.store')}}" class="flex flex-col gap-4">
                @csrf

                <div>
                    <x-input-label for="ev_name" value="{{ __('Name') }}" class="mb-2.5"/>
                    <x-text-input
                        id="ev_name"
                        name="name"
                        type="text"
                        class="block w-full"
                        placeholder="{{ __('Name') }}"
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="ev_date" value="{{ __('Date') }}" class="mt-2 mb-2.5"/>
                    <x-text-input
                        id="ev_date"
                        name="date"
                        type="date"
                        class="block w-full dark:[color-scheme:dark]"
                        placeholder="{{ __('Date') }}"
                    />
                    <x-input-error :messages="$errors->get('date')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="ev_time" value="{{ __('Time') }}" class="mt-0.5 mb-2.5"/>
                    <div class="flex justify-between items-center gap-2 mt-1">
                        <x-text-input
                            id="ev_start_time"
                            name="start_time"
                            type="time"
                            class="block w-full dark:[color-scheme:dark]"
                        />
                        <span class="dark:text-gray-100">To</span>
                        <x-text-input
                            id="ev_end_time"
                            name="end_time"
                            type="time"
                            class="block w-full dark:[color-scheme:dark]"
                        />
                    </div>
                    <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
                    <x-input-error :messages="$errors->get('end_time')" class="mt-2" />
                </div>

                <div class="mt-6 flex">
                    <x-primary-button>
                        {{__('Create')}}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <!-- Repeat this block for each event -->
            @foreach($events as $event)
                @php
                $start_time = date("g:i A", strtotime($event->start_time));
                $end_time = date("g:i A", strtotime($event->end_time));
                $date = date("d/m/Y", strtotime($event->date));
                @endphp
            <div  class="scale-100 p-4 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none motion-safe:hover:scale-[1.01] transition-all duration-250 ">
                <a href="{{route('events.show', ['event'=>$event->id])}}" class="focus:outline focus:outline-2 focus:outline-red-500">

                    <div class="flex justify-between">
                        <!-- Event Name -->
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{$event->name}}</h2>
                    </div>


                    <!-- Date -->
                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-2 pt-2">Date: <span class="font-semibold">{{$date}}</span></p>

                    <!-- Start and End Time -->
                    <p class="text-gray-500 dark:text-gray-400 text-sm pt-3">Time: <span class="font-semibold">{{$start_time}} - {{$end_time}}</span></p>
                </a>
            </div>


            @endforeach
            <!-- Repeat this block for each event -->
        </div>
    </div>


    {{$events->links()}}
</x-app-layout>
