<?php

use App\Http\Controllers\Panel\BrandController;
use App\Http\Controllers\Panel\PanelController;
use App\Http\Controllers\Site\SiteController;

use Illuminate\Support\Facades\Route;


/** Rotas panel */
Route::group(['prefix' => 'panel'], function() {
    Route::any('brands/search', [BrandController::class, 'search'])->name('brands.search');
    Route::resource('brands', BrandController::class);
    Route::get('/', [PanelController::class, 'index'])->name('panel');
});


/** Rotas site */
Route::get('/promocoes', [SiteController::class, 'promotions'])->name('promotions');
Route::get('/', [SiteController::class, 'index'])->name('site.index');

require __DIR__.'/auth.php';
