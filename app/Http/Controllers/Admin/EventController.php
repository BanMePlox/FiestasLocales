<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Municipality;
use App\Models\MusicGenre;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with(['municipality.comarca', 'musicGenre', 'submittedBy'])
            ->withTrashed()
            ->latest();

        if ($request->filled('estado')) {
            match ($request->estado) {
                'pendiente' => $query->whereNull('approved_at'),
                'aprobado'  => $query->whereNotNull('approved_at'),
                'inactivo'  => $query->where('is_active', false),
                default     => null,
            };
        }

        $events = $query->paginate(20)->withQueryString();

        return view('admin.events.index', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load('municipality.comarca', 'musicGenre', 'submittedBy');
        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $municipalities = Municipality::orderBy('name')->get();
        $genres         = MusicGenre::orderBy('name')->get();

        return view('admin.events.edit', compact('event', 'municipalities', 'genres'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:200',
            'municipality_id' => 'required|exists:municipalities,id',
            'music_genre_id'  => 'nullable|exists:music_genres,id',
            'description'     => 'nullable|string|max:3000',
            'starts_at'       => 'required|date',
            'ends_at'         => 'nullable|date|after:starts_at',
            'venue'           => 'required|string|max:200',
            'address'         => 'nullable|string|max:300',
            'price'           => 'nullable|numeric|min:0',
            'min_age'         => 'nullable|integer|min:0|max:99',
            'website_url'     => 'nullable|url|max:500',
            'instagram_url'   => 'nullable|url|max:500',
            'is_active'       => 'boolean',
        ]);

        $event->update($validated);

        return redirect()->route('admin.eventos.index')->with('success', 'Evento actualizado.');
    }

    public function approve(Event $event)
    {
        $event->update(['approved_at' => now()]);

        return back()->with('success', "Evento \"{$event->name}\" aprobado y publicado.");
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.eventos.index')->with('success', 'Evento eliminado.');
    }
}
