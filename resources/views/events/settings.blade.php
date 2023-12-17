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
                <div class="max-w-xl">
{{--                    @include('profile.partials.update-password-form')--}}
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
                                        {{ __('Delete Account') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
