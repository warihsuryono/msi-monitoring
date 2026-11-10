<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\IspuDisplayController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(env('PANEL_PATH'));
});
Route::get('login', function () {
    return redirect(env('PANEL_PATH') . '/login');
})->name("login");

Route::get(env('PANEL_PATH') . '/menus/{direction}/{menu}', [MenuController::class, 'reorder']);
Route::get(env('PANEL_PATH') . '/childmenus/{direction}/{menu}', [MenuController::class, 'reorder']);


Route::get('/display/ispu/{deviceId}', [IspuDisplayController::class, 'show'])->whereNumber('deviceId')->name('display.ispu');
Route::get('/display/ispu/{deviceId}/data', [IspuDisplayController::class, 'data'])->whereNumber('deviceId')->name('display.ispu.data');
