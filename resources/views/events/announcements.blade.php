<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Announcements') }}
            </h2>

            @if($event->user->is(auth()->user()))
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-announcement')">{{__('Create')}}</x-primary-button>
            @endif
        </div>
    </x-slot>
    <x-modal name="create-announcement" :show="$errors->isNotEmpty()" focusable>
        <div class="flex flex-col gap-4 p-4">
            <div class="text-start">
                <div class="text-2xl font-bold dark:text-gray-100">
                    {{__('Create an Announcement')}}
                </div>
                <div class="font-light text-gray-300 mt-2">
                    {{__('Announce something to the participants')}}
                </div>
            </div>
            <form method="post" action="{{route('events.announcements.store', $event)}}" class="flex flex-col gap-4" id="annc_form">
                @csrf

                <div>
                    <x-input-label for="ev_name" value="{{ __('Title') }}" class="mb-2.5"/>
                    <x-text-input
                        id="ev_name"
                        name="title"
                        type="text"
                        class="block w-full"
                        placeholder="{{ __('title') }}"
                    />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="text-input" value="{{ __('Content') }}" class="mt-2 mb-2.5"/>
                    <textarea id="message" name="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                </div>

                <div class="mt-6 flex">
                    <x-primary-button>
                        {{__('Create')}}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>

    @if(count($event->announcements()->get()) == 0)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("There are no announcements yet.") }}
                    </div>
                </div>
            </div>
        </div>
    @else
        @foreach($event->announcements()->get() as $announcement)
            <div class="py-12">
                <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg sm:p-6 lg:px-8 mb-4 text-white border-2 border-gray-800">
                    <div class="flex justify-between">
                        <h2 class="text-2xl font-bold mb-2 text-blue-600 dark:text-blue-400">📣 {{$announcement->title}}</h2>
                        @if ($event->user()->is(auth()->user()))
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link>
                                        {{ __('Edit') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        @endif
                    </div>

                    <p class="text-gray-800 dark:text-gray-500 mb-2">{{ DateTime::createFromFormat('Y-m-d H:i:s', $announcement->updated_at)->format('j M g:i A') }}</p>
                    <div class="mb-4">
                        <p class="text-md text-gray-900 dark:text-gray-300 leading-relaxed">
                            {{$announcement->content}}
                        </p>
                    </div>

                </div>

            </div>
        @endforeach
    @endif

</x-app-layout>
