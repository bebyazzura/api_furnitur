<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FurnitureController;
use App\Http\Controllers\AuthenticationController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () 
{
    Route::get('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/data_user', [AuthenticationController::class, 'data_user']);
    Route::post('/furnitures', [FurnitureController::class, 'store']);
    Route::patch('/furnitures/{id}', [FurnitureController::class, 'update'])->middleware('product-owner');
    Route::delete('/furnitures/{id}', [FurnitureController::class, 'destroy'])->middleware('product-owner');
});

Route::post('/login', [AuthenticationController::class, 'login']);
Route::get('/furnitures', [FurnitureController::class, 'index']);
Route::get('/furnitures/{id}', [FurnitureController::class, 'show']);