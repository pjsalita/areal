<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/designs', [ApiController::class, 'designs']);
Route::get('/userDesigns', [ApiController::class, 'userDesigns']);
Route::get('/userDesigns/{user}', [ApiController::class, 'userDesign']);
Route::get('/userDesigns/{user}/ids', [ApiController::class, 'userDesignIds']);
Route::get('/designs/{id}', [ApiController::class, 'design']);
