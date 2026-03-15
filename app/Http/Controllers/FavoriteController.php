<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $festivals = $request->user()
            ->favorites()
            ->with(['municipality.province', 'category'])
            ->active()
            ->upcoming()
            ->paginate(15);

        return view('favorites.index', compact('festivals'));
    }

    public function toggle(Festival $festival, Request $request)
    {
        $user = $request->user();
        $user->favorites()->toggle($festival->id);

        $isFavorited = $user->hasFavorited($festival);

        if ($request->wantsJson()) {
            return response()->json(['favorited' => $isFavorited]);
        }

        return back();
    }
}
