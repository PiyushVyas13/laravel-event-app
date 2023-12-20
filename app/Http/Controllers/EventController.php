<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        return view('events.index', [
            'events' => Event::with('user')->orderBy('date', 'desc')
                ->where('user_id', '=', $request->user()->id)
                    ->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date', 'after:today'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string']

        ]);

        $request->user()->events()->create($validated);
        notify()->success('Event created successfully!');

        return redirect(route('events.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event): View
    {
        return view('events.detail', [
            'event' => $event
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event): View|Response
    {
        try {
            $this->authorize('update', $event);
        } catch (AuthorizationException $e) {
            return response('You are not authorized!', '401');
        }

        return view('events.settings', [
            'event' => $event
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event): RedirectResponse
    {
        try {
            $this->authorize('update', $event);
        } catch (AuthorizationException $e) {
            notify()->error('You are not authorized!');
            return redirect(route('events.index'));
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date', 'after:today'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string']
        ]);

        $event->update($validated);
        notify()->success('Event updated');
        return redirect(route('events.edit', $event));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Event $event) : RedirectResponse
    {
        try {
            $this->authorize('delete', $event);
        } catch (AuthorizationException $e) {
            notify()->error('You are not authorized!');
            return redirect(route('events.index'));
        }

        $request->validateWithBag('eventDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $event->delete();
        notify()->success('Event deleted');
        return redirect(route('events.index'));
    }
}
