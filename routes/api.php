<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Download as ApiDownloadController;

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

// Routes for `Download` management in a group
Route::group(['prefix' => 'v1/downloads'], function(Router $route) {
    $route->get('index', [ApiDownloadController::class, 'index'])->name('downloads.index_api');
    $route->post('store', [ApiDownloadController::class, 'store'])->name('downloads.store_api');
    $route->get('{id}/download', [ApiDownloadController::class, 'download'])
        ->whereNumber('id')
        ->name('downloads.download_api');
});

// Not Found
Route::fallback(function(){
    return response()->json([
        'message' => 'Route not found!'], 404);
});
