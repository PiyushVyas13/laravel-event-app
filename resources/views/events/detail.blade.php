<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __($event->name) }}
            </h2>
            <div class="flex gap-x-8">
                @if($event->user->is(auth()->user()) || $event->participants->contains(auth()->user()))
                    <a href="{{ route('events.announcements.index', ['event'=>$event]) }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                    </a>
                @endif
                @if($event->user->is(auth()->user()))
                        <a href="{{ route('events.edit', ['event'=>$event]) }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                    @endif
            </div>
            @auth
                @if(!$event->user()->is(auth()->user()) &&  !$event->participants->contains(auth()->user()))
                    <div>
                        <form action="{{route('event.add-participant', $event)}}" method="post">
                            @csrf
                            @method('patch')

                            <input name="user_id" type="hidden" value="{{auth()->user()->getAuthIdentifier()}}" />

                            <x-primary-button>
                                Register
                            </x-primary-button>
                        </form>

                    </div>
                @endif

            @endauth
        </div>
    </x-slot>
    @php
        $start_time = date("g:i A", strtotime($event->start_time));
        $end_time = date("g:i A", strtotime($event->end_time));
        $date = date("d/m/Y", strtotime($event->date));
    @endphp
    <div class="p-12 max-width-4xl">
        <h1 class="font-bold text-gray-900 dark:text-gray-100 text-6xl" >{{$event->name}}</h1><br>
        <div class="flex flex-col" style="gap: 20px">
            <img src="{{url('/images/image1.avif')}}" class="rounded-md ms-2 max-w-xl">
            <p class="text flexbox text-gray-900 dark:text-gray-100">
                <b> Singer :</b>{{$event->user->name}}<br>
                <br>
                <b>Location :</b>{{$event->location}}<br><br>
                <b>Date :</b>{{$date}}<br><br>
                <b>Time :</b> {{$start_time}} to {{$end_time}}<br><br>
                <b>Event Description :</b>
                <br>
                {{$event->description}}
            </p>
        </div>
        <br><br>
        <div class="icon">
            <center><h2 style="font-size: 50px;font-family:Verdana, Geneva, Tahoma, sans-serif" class="text-gray-900 dark:text-gray-100">Singer</h2><br>
                <img src="{{url('images/darshan.jpeg')}}" style="border-radius:100%"/><center>

        </div>
        <br><br>
        <center><h2 style="font-size: 50px;font-family:Verdana, Geneva, Tahoma, sans-serif" class="text-gray-900 dark:text-gray-100">Sponsers</h2><br></center>
        <div class="sponsers flex mx-48">
            <img src="{{url('/images/book.png')}}">
            <img src="{{url('/images/book.png')}}">
            <img src="{{url('/images/echo.png')}}">
        </div>
    </div>



</x-app-layout>
