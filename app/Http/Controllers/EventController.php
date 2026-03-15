<?php

namespace App\Http\Controllers;

use App\Models\Comarca;
use App\Models\Event;
use App\Models\Municipality;
use App\Models\MusicGenre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        $events    = $query->paginate(15)->withQueryString();
        $comarcas  = Comarca::orderBy('name')->get();
        $genres    = MusicGenre::orderBy('name')->get();

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
        $municipalities = Municipality::orderBy('name')->get();
        $genres         = MusicGenre::orderBy('name')->get();

        return view('events.create', compact('municipalities', 'genres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:200',
            'municipality_id' => 'required|exists:municipalities,id',
            'music_genre_id'  => 'nullable|exists:music_genres,id',
            'description'     => 'nullable|string|max:3000',
            'starts_at'       => 'required|date|after:now',
            'ends_at'         => 'nullable|date|after:starts_at',
            'venue'           => 'required|string|max:200',
            'address'         => 'nullable|string|max:300',
            'price'           => 'nullable|numeric|min:0|max:999',
            'min_age'         => 'nullable|integer|min:0|max:99',
            'website_url'     => 'nullable|url|max:500',
            'instagram_url'   => 'nullable|url|max:500',
            'cover_image'     => 'nullable|image|max:3072',
        ]);

        $imagePath = null;
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('events', 'public');
        }

        Event::create(array_merge($validated, [
            'submitted_by' => Auth::id(),
            'cover_image'  => $imagePath,
            'is_active'    => true,
            'approved_at'  => null, // Pendiente de aprobación
        ]));

        return redirect()->route('events.index')
            ->with('success', 'Evento enviado. Lo revisaremos y lo publicaremos en breve. ¡Gracias!');
    }
}
