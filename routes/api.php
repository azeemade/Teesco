<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImprintController;
use App\Http\Controllers\SizeController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['prefix' => 'v1'], function ($router) {
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('products/{product}', [ProductController::class, 'show']);
    Route::post('/product', [ProductController::class, 'updateOrCreate']);
    Route::delete('products/{product}', [ProductController::class, 'destroy']);
    Route::get('/csv', [ProductController::class, 'exportCSV']);

    Route::get('/sizes', [SizeController::class, 'index']);
    Route::get('/imprints', [ImprintController::class, 'index']);
});
