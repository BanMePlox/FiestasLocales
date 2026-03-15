<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Festival;
use App\Models\Province;
use Illuminate\Http\Request;

class FestivalController extends Controller
{
    public function index(Request $request)
    {
        $query = Festival::with(['municipality.province', 'category'])
            ->active()
            ->upcoming();

        if ($request->filled('provincia')) {
            $province = Province::where('slug', $request->provincia)->first();
            if ($province) {
                $query->byProvince($province->id);
            }
        }

        if ($request->filled('categoria')) {
            $category = Category::where('slug', $request->categoria)->first();
            if ($category) {
                $query->byCategory($category->id);
            }
        }

        if ($request->filled('desde') || $request->filled('hasta')) {
            $query->byDateRange($request->desde, $request->hasta);
        }

        if ($request->filled('q')) {
            $query->search($request->q);
        }

        $festivals = $query->paginate(15)->withQueryString();

        $provinces   = Province::orderBy('name')->get();
        $categories  = Category::orderBy('name')->get();

        return view('festivals.index', compact('festivals', 'provinces', 'categories'));
    }

    public function show(Festival $festival)
    {
        $festival->increment('views_count');

        $festival->load(['municipality.province', 'category', 'images']);

        $related = Festival::with(['municipality.province', 'category'])
            ->active()
            ->upcoming()
            ->where('id', '!=', $festival->id)
            ->where(function ($q) use ($festival) {
                $q->where('category_id', $festival->category_id)
                  ->orWhere('municipality_id', $festival->municipality_id);
            })
            ->limit(3)
            ->get();

        $isFavorited = auth()->check() && auth()->user()->hasFavorited($festival);

        return view('festivals.show', compact('festival', 'related', 'isFavorited'));
    }
}
