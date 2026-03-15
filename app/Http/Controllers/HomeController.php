<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Festival;
use App\Models\Province;

class HomeController extends Controller
{
    public function index()
    {
        $featuredFestivals = Festival::with(['municipality.province', 'category'])
            ->active()
            ->featured()
            ->upcoming()
            ->limit(6)
            ->get();

        $upcomingFestivals = Festival::with(['municipality.province', 'category'])
            ->active()
            ->upcoming()
            ->limit(8)
            ->get();

        $provinces = Province::withCount(['municipalities' => function ($q) {
            $q->whereHas('festivals', fn ($f) => $f->active());
        }])->get();

        $categories = Category::withCount(['festivals' => fn ($q) => $q->active()])
            ->whereHas('festivals', fn ($q) => $q->active())
            ->get();

        return view('pages.home', compact('featuredFestivals', 'upcomingFestivals', 'provinces', 'categories'));
    }
}
