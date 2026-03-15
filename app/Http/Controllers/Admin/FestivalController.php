<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Festival;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FestivalController extends Controller
{
    public function index()
    {
        $festivals = Festival::with(['municipality.province', 'category'])
            ->withTrashed()
            ->latest()
            ->paginate(20);

        return view('admin.festivals.index', compact('festivals'));
    }

    public function create()
    {
        $municipalities = Municipality::with('province')->orderBy('name')->get();
        $categories     = Category::orderBy('name')->get();

        return view('admin.festivals.create', compact('municipalities', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'municipality_id'   => 'required|exists:municipalities,id',
            'category_id'       => 'required|exists:categories,id',
            'name'              => 'required|string|max:255',
            'description'       => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'start_date'        => 'required|date',
            'end_date'          => 'required|date|after_or_equal:start_date',
            'website_url'       => 'nullable|url|max:500',
            'address'           => 'nullable|string|max:300',
            'is_active'         => 'boolean',
            'is_featured'       => 'boolean',
        ]);

        $validated['is_active']   = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['published_at'] = $validated['is_active'] ? now() : null;

        Festival::create($validated);

        return redirect()->route('admin.fiestas.index')
            ->with('success', 'Fiesta creada correctamente.');
    }

    public function edit(Festival $festival)
    {
        $municipalities = Municipality::with('province')->orderBy('name')->get();
        $categories     = Category::orderBy('name')->get();

        return view('admin.festivals.edit', compact('festival', 'municipalities', 'categories'));
    }

    public function update(Request $request, Festival $festival)
    {
        $validated = $request->validate([
            'municipality_id'   => 'required|exists:municipalities,id',
            'category_id'       => 'required|exists:categories,id',
            'name'              => 'required|string|max:255',
            'description'       => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'start_date'        => 'required|date',
            'end_date'          => 'required|date|after_or_equal:start_date',
            'website_url'       => 'nullable|url|max:500',
            'address'           => 'nullable|string|max:300',
            'is_active'         => 'boolean',
            'is_featured'       => 'boolean',
        ]);

        $validated['is_active']   = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($validated['is_active'] && !$festival->published_at) {
            $validated['published_at'] = now();
        }

        $festival->update($validated);

        return redirect()->route('admin.fiestas.index')
            ->with('success', 'Fiesta actualizada correctamente.');
    }

    public function destroy(Festival $festival)
    {
        $festival->delete();

        return redirect()->route('admin.fiestas.index')
            ->with('success', 'Fiesta eliminada.');
    }

    public function show(Festival $festival)
    {
        $festival->load(['municipality.province', 'category']);

        return view('admin.festivals.show', compact('festival'));
    }
}
