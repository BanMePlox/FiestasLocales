<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Festival;
use App\Models\Municipality;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'festivals'    => Festival::count(),
            'active'       => Festival::active()->count(),
            'municipalities' => Municipality::count(),
            'categories'   => Category::count(),
            'users'        => User::count(),
        ];

        $latestFestivals = Festival::with(['municipality', 'category'])
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'latestFestivals'));
    }
}
