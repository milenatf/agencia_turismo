<?php

use App\Http\Controllers\Panel\BrandController;
use App\Http\Controllers\Panel\PanelController;
use App\Http\Controllers\Site\SiteController;

use Illuminate\Support\Facades\Route;


/** Rotas panel */
Route::group(['prefix' => 'panel'], function() {
    Route::get('/', [PanelController::class, 'index'])->name('panel');
    Route::resource('brands', BrandController::class);
});


/** Rotas site */
Route::get('/promocoes', [SiteController::class, 'promotions'])->name('promotions');
Route::get('/', [SiteController::class, 'index'])->name('site.index');

require __DIR__.'/auth.php';
