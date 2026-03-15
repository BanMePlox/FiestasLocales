<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Models\Comarca;
use App\Models\Event;
use App\Models\Municipality;
use App\Models\MusicGenre;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with(['municipality.comarca', 'musicGenre'])
            ->active()
            ->upcoming();

        if ($request->filled('comarca')) {
            $query->byComarca($request->comarca);
        }

        if ($request->filled('genero')) {
            $query->byGenre($request->genero);
        }

        if ($request->filled('municipio')) {
            $query->byMunicipality($request->municipio);
        }

        $events   = $query->paginate(15)->withQueryString();
        $comarcas = Comarca::orderBy('name')->get();
        $genres   = MusicGenre::orderBy('name')->get();

        return view('events.index', compact('events', 'comarcas', 'genres'));
    }

    public function show(Event $event)
    {
        if (!$event->isApproved() || !$event->is_active) {
            abort(404);
        }

        $event->load('municipality.comarca.province', 'musicGenre', 'submittedBy');

        $related = Event::with(['municipality', 'musicGenre'])
            ->active()
            ->upcoming()
            ->where('id', '!=', $event->id)
            ->where(function ($q) use ($event) {
                $q->where('municipality_id', $event->municipality_id)
                  ->orWhere('music_genre_id', $event->music_genre_id);
            })
            ->limit(3)
            ->get();

        return view('events.show', compact('event', 'related'));
    }

    public function create()
    {
        $this->authorize('create', Event::class);

        $municipalities = Municipality::orderBy('name')->get();
        $genres         = MusicGenre::orderBy('name')->get();

        return view('events.create', compact('municipalities', 'genres'));
    }

    public function store(StoreEventRequest $request)
    {
        $this->authorize('create', Event::class);

        $imagePath = $request->hasFile('cover_image')
            ? $request->file('cover_image')->store('events', 'public')
            : null;

        Event::create(array_merge($request->validated(), [
            'submitted_by' => $request->user()->id,
            'cover_image'  => $imagePath,
            'is_active'    => true,
            'approved_at'  => null,
        ]));

        return redirect()->route('events.index')
            ->with('success', 'Evento enviado. Lo revisaremos y lo publicaremos en breve. ¡Gracias!');
    }
}
