<?php

use App\Http\Controllers\Panel\PanelController;
use Illuminate\Support\Facades\Route;

Route::get('/panel', [PanelController::class, 'index'])->name('panel.index');

Route::get('/', function () {
    return view('welcome');
});
