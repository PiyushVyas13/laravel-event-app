<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Event;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        return view('events.announcements', ['event' => $event]);
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
    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title'=> 'required|string|max:255',
            'content' => 'required',
        ]);

        $event->announcements()->create($validated);
        notify()->success('Announcement created');
        return redirect(route('events.announcements.index', $event));
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event, Announcement $announcement)
    {
        $validated = $request->validate([
            'title'=> 'required|string|max:255',
            'content' => 'required',
        ]);

        $announcement->update($validated);
        notify()->success('Announcement updated');
        return redirect(route('events.announcements.index', $event));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event, Announcement $announcement)
    {
        $announcement->delete();
        notify()->success('Announcement deleted');
        return redirect(route('events.announcements.index', $event));
    }
}
