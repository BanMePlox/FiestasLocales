<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\FestivalController as AdminFestivalController;
use App\Http\Controllers\Admin\MunicipalityController as AdminMunicipalityController;
use App\Http\Controllers\ComarcaController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sobre-nosotros', fn () => view('pages.about'))->name('about');
Route::get('/contacto', fn () => view('pages.contact'))->name('contact');

// Festival browsing (public)
Route::get('/fiestas', [FestivalController::class, 'index'])->name('festivals.index');
Route::get('/fiestas/{festival:slug}', [FestivalController::class, 'show'])->name('festivals.show');

// Comarcas (public)
Route::get('/comarcas/{comarca:slug}', [ComarcaController::class, 'show'])->name('comarcas.show');

// Events / fiestas con música
Route::get('/eventos', [EventController::class, 'index'])->name('events.index');
Route::get('/eventos/proponer', [EventController::class, 'create'])->middleware('auth')->name('events.create');
Route::post('/eventos', [EventController::class, 'store'])->middleware('auth')->name('events.store');
Route::get('/eventos/{event:slug}', [EventController::class, 'show'])->name('events.show');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::get('/mis-favoritos', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favoritos/{festival}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('fiestas', AdminFestivalController::class)->parameters(['fiestas' => 'festival']);
        Route::resource('categorias', AdminCategoryController::class)->parameters(['categorias' => 'category']);
        Route::resource('municipios', AdminMunicipalityController::class)
            ->parameters(['municipios' => 'municipality'])
            ->only(['index', 'edit', 'update']);

        // Eventos con música
        Route::resource('eventos', AdminEventController::class)
            ->parameters(['eventos' => 'event'])
            ->only(['index', 'show', 'edit', 'update', 'destroy']);
        Route::post('eventos/{event}/aprobar', [AdminEventController::class, 'approve'])->name('eventos.approve');
    });

require __DIR__.'/auth.php';
