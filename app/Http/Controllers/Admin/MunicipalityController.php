<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateMunicipalityRequest;
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

    public function update(UpdateMunicipalityRequest $request, Municipality $municipality)
    {
        $municipality->update($request->validated());

        return redirect()->route('admin.municipios.index')
            ->with('success', 'Municipio actualizado.');
    }

    public function create() { abort(404); }
    public function store(Request $request) { abort(404); }
    public function show(Municipality $municipality) { abort(404); }
    public function destroy(Municipality $municipality) { abort(404); }
}
