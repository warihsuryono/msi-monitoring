<?php

use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(env('PANEL_PATH') . '/dashboard');
});
Route::get('login', function () {
    return redirect(env('PANEL_PATH') . '/login');
})->name("login");

Route::get(env('PANEL_PATH') . '/menus/{direction}/{menu}', [MenuController::class, 'reorder']);
Route::get(env('PANEL_PATH') . '/childmenus/{direction}/{menu}', [MenuController::class, 'reorder']);
