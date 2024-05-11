<?php

use App\Http\Controllers\Api\ApiAtivoController;
use App\Http\Controllers\Api\ApiLoginController;
use Illuminate\Support\Facades\Route;

Route::apiResource('api-ativo', ApiAtivoController::class);

Route::post('/login', [ApiLoginController::class, 'login'])->name('api-login');
