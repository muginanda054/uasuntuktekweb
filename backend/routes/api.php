<?php

use App\Http\Controllers\Api\AkunController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LowonganController;
use App\Http\Controllers\Api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
 });
 Route::post('/login', [LoginController::class, 'index']);
 Route::get('/logout', [LoginController::class, 'logout']);
Route::apiResource('/lowongans', LowonganController::class);
