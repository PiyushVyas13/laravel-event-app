@props([
    'id',
    'title',
    'date',
    'start_time',
    'end_time',
    'creator',
])

<div  class="scale-100 p-4 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none motion-safe:hover:scale-[1.01] transition-all duration-250 ">
    <a href="{{route('events.show', ['event'=>$id])}}" class="focus:outline focus:outline-2 focus:outline-red-500">

        <div class="flex justify-between">
            <!-- Event Name -->
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{$title}}</h2>
        </div>


        <!-- Date -->
        <p class="flex items-center gap-x-2 text-gray-500 dark:text-gray-400 text-sm mt-2 pt-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-days"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/><path d="M8 18h.01"/><path d="M12 18h.01"/><path d="M16 18h.01"/></svg>
            <span class="font-semibold">{{$date}}</span>
        </p>

        <!-- Start and End Time -->
        <p class="flex items-center gap-x-2 text-gray-500 dark:text-gray-400 text-sm pt-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <span class="font-semibold">{{$start_time}} - {{$end_time}}</span>
        </p>

        <p class="text-gray-500 dark:text-gray-400 text-sm pt-4">By <span class="font-semibold">{{$creator}}</span></p>
    </a>
</div>
