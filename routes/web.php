<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/bassi', function () {
    return view('bassi');
})->name('bassi');
Route::get('/trap', function () {
    return view('trap');
});
Route::get('/darshan', function () {
    return view('darshan');
});

Route::get('/nisha', function () {
    return view('nisha');
});


Route::get('/', function () {
    $today = now()->toDateString(); // Get today's date in 'Y-m-d' format
    $tenDaysLater = now()->addDays(10)->toDateString(); // Get date 10 days from now

    $eventsInRange = Event::whereBetween('date', [$today, $tenDaysLater])->get();
    dd($today);
    return view('welcome', ['events'=>$eventsInRange]);
});
Route::get('/aboutus',function(){
    return view('aboutus');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function (\Illuminate\Http\Request $request) {
    $events = Event::with('user')
        ->where('user_id', '<>', $request->user()->id)
        ->paginate(10);


    return view('dashboard', ['events' => $events]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('events', EventController::class)
    ->only(['index', 'store', 'show', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::patch('events/{event}/participants/add', function(Request $request, Event $event) : \Illuminate\Http\RedirectResponse {

    $validated = $request->validate([
       'user_id' => 'required|numeric',
    ]);

    $user = User::find($validated['user_id']);

    if(!$user) {
        notify()->error('Something went wrong');
        return redirect(route('events.index'));
    }
   $event->participants()->attach($user->id);
    notify()->success("You have successfully registered for $event->name");
    return redirect(route('events.show', $event));

})->name('event.add-participant');

Route::patch('events/{event}/participants/remove', function(Request $request, Event $event) {
    $validated = $request->validate([
        'participant_id' => 'required|numeric',
    ]);

    $user = User::find($validated['participant_id']);

    if(!$user) {
        notify()->error('Something went wrong');
        return redirect(route('events.index'));
    }
    $event->participants()->detach($user->id);
    notify()->success('Participant was removed');
    return redirect(route('events.edit', $event));
})->name('event.remove-participant');


Route::get('/events/{event}/participants/search', function(Request $request, Event $event) {
    if(!$request->has('query')) {
        return response()->json([
           'message' => 'query string is missing'
        ], 402);
    }

    $participants =
        $request->get('query') == '' ?
        $event->participants()->get() :
            $event->participants()
                ->where('name', 'like', $request->get('query')."%")
                ->get();;


    return $participants;

})->name('event.participants.search');

require __DIR__.'/auth.php';
