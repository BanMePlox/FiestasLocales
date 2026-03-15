<?php

namespace App\Http\Controllers;

use App\Models\Comarca;
use Illuminate\Http\Request;

class ComarcaController extends Controller
{
    public function show(Comarca $comarca)
    {
        $comarca->load('province', 'municipalities');

        $events = $comarca->events()
            ->with(['musicGenre', 'municipality'])
            ->upcoming()
            ->paginate(12);

        $pastEvents = $comarca->events()
            ->with(['musicGenre', 'municipality'])
            ->past()
            ->paginate(6);

        return view('comarcas.show', compact('comarca', 'events', 'pastEvents'));
    }
}
