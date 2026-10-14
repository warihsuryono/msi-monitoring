<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\IspuController;

Route::get('/ispu/{device_id}', [IspuController::class, 'index']);
