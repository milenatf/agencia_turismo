<?php

use App\Http\Controllers\Panel\AirportController;
use App\Http\Controllers\Panel\BrandController;
use App\Http\Controllers\Panel\CityController;
use App\Http\Controllers\Panel\FlightController;
use App\Http\Controllers\Panel\PanelController;
use App\Http\Controllers\Panel\PlaneController;
use App\Http\Controllers\Panel\StateController;
use App\Http\Controllers\Site\SiteController;

use Illuminate\Support\Facades\Route;


/** Rotas panel */
Route::group(['prefix' => 'panel'], function() {
    Route::any('brands/search', [BrandController::class, 'search'])->name('brands.search');
    Route::get('brands/{id}/planes', [BrandController::class, 'planes'])->name('brands.planes');
    Route::resource('brands', BrandController::class);

    Route::any('planes/search', [PlaneController::class, 'search'])->name('planes.search');
    Route::resource('planes', PlaneController::class);

    Route::any('states/search', [StateController::class, 'search'])->name('states.search');
    Route::get('states', [StateController::class, 'index'])->name('states.index');

    route::any('state/{initials}/cities/search', [CityController::class, 'search'])->name('state.cities.search');
    route::get('state/{initials}/cities', [CityController::class, 'index'])->name('state.cities');

    Route::any('flights/search', [flightController::class, 'search'])->name('flights.search');
    Route::resource('flights', FlightController::class);

    Route::any('city/{id}/airports/search', [AirportController::class, 'search'])->name('airports.search');
    Route::resource('city/{id}/airports', AirportController::class);

    Route::get('/', [PanelController::class, 'index'])->name('panel');
});


/** Rotas site */
Route::get('/promocoes', [SiteController::class, 'promotions'])->name('promotions');
Route::get('/', [SiteController::class, 'index'])->name('site.index');

require __DIR__.'/auth.php';
