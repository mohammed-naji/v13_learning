<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('login', [AuthController::class, 'login']);

Route::prefix('v1')->middleware('auth:sanctum')->group(function() {
    Route::apiResource('courses', CourseController::class);
});

// Route::prefix('v2')->group(function() {
//     Route::get('courses', );
// })


