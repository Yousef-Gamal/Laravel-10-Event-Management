<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\{EventController,AtendeeController};


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

Route::apiResource('events',EventController::class);
// you don't really need to pass the parameters because laravel already know the relationship between them
//Route::apiResource('events.attendees',AtendeeController::class)->scoped(['attendee' => 'event']);
Route::apiResource('events.attendees',AtendeeController::class)->scoped()->except('update');
