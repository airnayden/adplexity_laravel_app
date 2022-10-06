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

Route::group(['prefix' => 'v1/downloads'], function(Router $route) {
    $route->get('index', [ApiDownloadController::class, 'index'])->name('downloads.index_api');
    $route->post('store', [ApiDownloadController::class, 'store'])->name('downloads.store_api');
});
