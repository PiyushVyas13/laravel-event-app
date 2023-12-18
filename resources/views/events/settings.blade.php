@php $participantId=null; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Event Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Event Info') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Update your event's information.") }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('events.update', ['event'=>$event]) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $event->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="date" :value="__('Date')" />
                                <x-text-input id="date" name="date" type="date" class="mt-1 block w-full dark:[color-scheme:dark]" :value="old('date', $event->date)" required autocomplete="Date" />
                                <x-input-error class="mt-2" :messages="$errors->get('date')" />

                            </div>

                            <div>
                                <x-input-label for="ev_time" value="{{ __('Time') }}" class="mt-0.5 mb-2.5"/>
                                <div class="flex justify-between items-center gap-2 mt-1">
                                    <x-text-input
                                        id="ev_start_time"
                                        name="start_time"
                                        type="time"
                                        class="block w-full dark:[color-scheme:dark]"
                                        :value="old('start_time', $event->start_time)"
                                    />
                                    <span class="dark:text-gray-100">To</span>
                                    <x-text-input
                                        id="ev_end_time"
                                        name="end_time"
                                        type="time"
                                        class="block w-full dark:[color-scheme:dark]"
                                        :value="old('end_time', $event->end_time)"
                                    />
                                </div>
                                <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
                                <x-input-error :messages="$errors->get('end_time')" class="mt-2" />
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>
                        </form>
                    </section>

                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="w-full">
{{--                    @include('profile.partials.update-password-form')--}}
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Participants') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Manage participants for this event") }}
                            </p>
                        </header>


                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
                            <div class="pb-4">
                                <label for="table-search" class="sr-only">Search</label>
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="searchInput" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for participants">
                                </div>
                            </div>
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 rounded-md">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            <input id="cbox" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="cbox" class="sr-only">checkbox</label>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-3 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-3 py-3">
                                        Email
                                    </th>
                                    <th scope="col" class="px-3 py-3">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="participantTableBody">
                                @foreach($event->participants()->get() as $participant)

                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="w-4 p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                            </div>
                                        </td>
                                        <th scope="row" class="px-3 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{$participant->name}}
                                        </th>
                                        <td class="px-3 py-4">
                                            {{$participant->email}}
                                        </td>
                                        <td class="px-3 py-4 pl-6">
                                            <button type="button" @click.prevent="$dispatch('open-modal', 'participant-removal')" class="font-medium text-blue-600 dark:text-rose-500 hover:underline par_remove" data-id="{{$participant->id}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                            </button>
                                        </td>
                                    </tr>

                                @endforeach
                                @if(count($event->participants()->get()) == 0)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="w-4 p-4"></td>
                                        <td class="px-3 py-4">
                                            {{__('There are no participants yet.')}}
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <x-modal name="participant-removal" focusable>
                            <form method="post" action="{{ route('event.remove-participant', $event) }}" class="p-6">
                                @csrf
                                @method('patch')

                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Are you sure you want to remove this participant?') }}
                                </h2>

                                <input type="hidden" id="par_id" name="participant_id" value="{{$participantId || -1}}" />
                                <div class="mt-6 flex flex-row-reverse justify-end gap-x-3">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>

                                    <x-danger-button class="ms-3">
                                        {{ __('Remove') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                    </section>

                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
{{--                    @include('profile.partials.delete-user-form')--}}
                    <section class="space-y-6">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Delete Event') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Delete this event from the system') }}
                            </p>
                        </header>

                        <x-danger-button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-event-deletion')"
                        >{{ __('Delete Event') }}</x-danger-button>

                        <x-modal name="confirm-event-deletion" :show="$errors->eventDeletion->isNotEmpty()" focusable>
                            <form method="post" action="{{ route('events.destroy', $event) }}" class="p-6">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Are you sure you want to delete '.$event->name.'?') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('Please enter your password to confirm you would like to permanently this event.') }}
                                </p>

                                <div class="mt-6">
                                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                                    <x-text-input
                                        id="password"
                                        name="password"
                                        type="password"
                                        class="mt-1 block w-3/4"
                                        placeholder="{{ __('Password') }}"
                                    />

                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>

                                    <x-danger-button class="ms-3">
                                        {{ __('Delete') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                    </section>

                </div>
            </div>
        </div>
    </div>
    <script>
        function handleClick(e) {
            $dispatch('open-modal', 'participant-removal');
            const btn = document.querySelector('.par_remove');
            const par_id = btn.dataset.id;
            const field = document.getElementById('par_id');
            field.value = par_id;
        }
    </script>
    <script type="module">
        import {debounce} from "../../../node_modules/alpinejs/src/utils/debounce.js";

        $(document).ready(function() {
            const searchInput = $('#searchInput');
            const debouncedSearch = debounce(() => {
                const keyword = searchInput.val().trim();
                    $.ajax({
                        url: '{{ route('event.participants.search', $event) }}',
                        method: 'GET',
                        data: {query: keyword},
                        success: function(response) {
                            console.log("HELLO")
                            const participants = response;
                            console.log(response);
                            $('#participantTableBody').empty();
                            if(participants.length == 0) {
                                const ap = `
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="w-4 p-4"></td>
                                        <td class="px-3 py-4">
                                            {{__('No participants matched.')}}
                                        </td>
                                    </tr>

`
                                $('#participantTableBody').append(ap);
                            }
                            else {
                                participants.forEach(function(participant) {
                                    const row = `
                                     <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="w-4 p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                            </div>
                                        </td>
                                        <th scope="row" class="px-3 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{$participant->name}}
                                        </th>
                                        <td class="px-3 py-4">
                                            {{$participant->email}}
                                        </td>
                                        <td class="px-3 py-4 pl-6">
                                        <button type="button" @click.prevent="$dispatch('open-modal', 'participant-removal')" class="font-medium text-blue-600 dark:text-rose-500 hover:underline par_remove" data-id="{{$participant->id}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                            </button>
                                        </td>
                                    </tr>
                                    `;
                                    $('#participantTableBody').append(row);
                                });
                            }

                        }
                    });
            }, 250); // Delay of 250ms before making request

            searchInput.on('keyup', debouncedSearch);
        });

    </script>
</x-app-layout>
