<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\Festival;
use App\Models\Municipality;
use App\Models\User;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'festivals'      => Festival::count(),
            'festivals_active' => Festival::active()->count(),
            'events_total'   => Event::count(),
            'events_pending' => Event::pending()->count(),
            'municipalities' => Municipality::count(),
            'users'          => User::count(),
        ];

        // Eventos pendientes de aprobación (los más urgentes)
        $pendingEvents = Event::with(['municipality.comarca', 'musicGenre', 'submittedBy'])
            ->pending()
            ->oldest()
            ->limit(5)
            ->get();

        // Próximos eventos aprobados (esta semana y siguiente)
        $upcomingEvents = Event::with(['municipality', 'musicGenre'])
            ->active()
            ->upcoming()
            ->where('starts_at', '<=', Carbon::now()->addDays(14))
            ->limit(5)
            ->get();

        // Últimas fiestas añadidas
        $latestFestivals = Festival::with(['municipality', 'category'])
            ->latest()
            ->limit(5)
            ->get();

        // Últimos usuarios registrados
        $latestUsers = User::latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'stats',
            'pendingEvents',
            'upcomingEvents',
            'latestFestivals',
            'latestUsers',
        ));
    }
}
