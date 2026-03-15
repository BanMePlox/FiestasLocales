<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Municipality;
use App\Models\Province;
use Illuminate\Http\Request;

class MunicipalityController extends Controller
{
    public function index(Request $request)
    {
        $query = Municipality::with('province')->withCount('festivals');

        if ($request->filled('province_id')) {
            $query->where('province_id', $request->province_id);
        }

        $municipalities = $query->orderBy('name')->paginate(30);
        $provinces      = Province::orderBy('name')->get();

        return view('admin.municipalities.index', compact('municipalities', 'provinces'));
    }

    public function edit(Municipality $municipality)
    {
        $provinces = Province::orderBy('name')->get();

        return view('admin.municipalities.edit', compact('municipality', 'provinces'));
    }

    public function update(Request $request, Municipality $municipality)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:150',
            'province_id' => 'required|exists:provinces,id',
            'lat'         => 'nullable|numeric',
            'lng'         => 'nullable|numeric',
            'population'  => 'nullable|integer|min:0',
        ]);

        $municipality->update($validated);

        return redirect()->route('admin.municipalities.index')
            ->with('success', 'Municipio actualizado.');
    }

    public function create() { abort(404); }
    public function store(Request $request) { abort(404); }
    public function show(Municipality $municipality) { abort(404); }
    public function destroy(Municipality $municipality) { abort(404); }
}
