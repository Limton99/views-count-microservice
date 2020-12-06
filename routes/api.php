<?php

use App\Http\Controllers\NbViewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/{projectId}/{entityId}/{objectId}/', [NbViewsController::class, 'increment']);
Route::get('/{projectId}/{entityId}/{objectId}/', [NbViewsController::class, 'show']);
Route::get('/{projectId}/{entityId}/{objectId}/periods/', [NbViewsController::class, 'showByDate']);
