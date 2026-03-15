<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateEventRequest;
use App\Models\Event;
use App\Models\Municipality;
use App\Models\MusicGenre;
use App\Notifications\EventApproved;
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

    public function update(UpdateEventRequest $request, Event $event)
    {
        $data              = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        $event->update($data);

        return redirect()->route('admin.eventos.index')
            ->with('success', 'Evento actualizado.');
    }

    public function approve(Event $event)
    {
        $event->load('municipality');
        $event->update(['approved_at' => now()]);

        // Notificar al autor si el evento fue propuesto por un usuario
        if ($event->submitted_by && $event->submittedBy) {
            $event->submittedBy->notify(new EventApproved($event));
        }

        return back()->with('success', "Evento \"{$event->name}\" aprobado y publicado.");
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.eventos.index')
            ->with('success', 'Evento eliminado.');
    }
}
