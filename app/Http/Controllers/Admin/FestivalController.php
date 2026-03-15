<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFestivalRequest;
use App\Http\Requests\Admin\UpdateFestivalRequest;
use App\Models\Category;
use App\Models\Festival;
use App\Models\Municipality;

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

    public function store(StoreFestivalRequest $request)
    {
        $data = $request->validated();
        $data['is_active']    = $request->boolean('is_active');
        $data['is_featured']  = $request->boolean('is_featured');
        $data['published_at'] = $data['is_active'] ? now() : null;

        Festival::create($data);

        return redirect()->route('admin.fiestas.index')
            ->with('success', 'Fiesta creada correctamente.');
    }

    public function edit(Festival $festival)
    {
        $municipalities = Municipality::with('province')->orderBy('name')->get();
        $categories     = Category::orderBy('name')->get();

        return view('admin.festivals.edit', compact('festival', 'municipalities', 'categories'));
    }

    public function update(UpdateFestivalRequest $request, Festival $festival)
    {
        $data = $request->validated();
        $data['is_active']   = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');

        if ($data['is_active'] && !$festival->published_at) {
            $data['published_at'] = now();
        }

        $festival->update($data);

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
