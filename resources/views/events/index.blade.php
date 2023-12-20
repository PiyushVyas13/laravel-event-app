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

                <div>
                    <x-input-label for="ev_location" value="{{ __('Location') }}" class="mt-2 mb-2.5"/>
                    <x-text-input
                        id="ev_location"
                        name="location"
                        type="text"
                        class="block w-full dark:[color-scheme:dark]"
                        placeholder="{{ __('Location') }}"
                    />
                    <x-input-error :messages="$errors->get('location')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="ev_desc" value="{{ __('Description') }}" class="mt-2 mb-2.5"/>
                    <textarea id="message" name="description" rows="4" class="w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Announce something...">

                    </textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
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
                <x-event-card
                    :id="$event->id"
                    :title="$event->name"
                    :date="$date"
                    :start_time="$start_time"
                    :end_time="$end_time"
                    :location="$event->location"
                    :description="$event->description"
                    :creator="$event->user->name"
                />
                @endforeach
            <!-- Repeat this block for each event -->
        </div>
        @if(count($events) == 0)
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            {{ __("You have not created any events.") }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>


    {{$events->links()}}
</x-app-layout>
