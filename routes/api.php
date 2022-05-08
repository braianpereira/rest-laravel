<?php

use App\Http\Controllers\Api\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Products Route
Route::prefix('products')->group(function (){
    Route::get('/',  [ProductController::class, 'index']);
    Route::get('/{id}',  [ProductController::class, 'show']);
    Route::post('/',  [ProductController::class, 'save']);
    Route::put('/{id}',  [ProductController::class, 'update']);
    Route::patch('/{id}',  [ProductController::class, 'update']);
    Route::delete('/{id}',  [ProductController::class, 'remove']);
});


