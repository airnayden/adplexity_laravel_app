<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\Download as WebDownloadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // Redirect to Downloads list
    return redirect('downloads/index');
});

// Routes for `Customer` management
Route::get('downloads/index', [WebDownloadController::class, 'index'])->name('downloads.index_web');
Route::get('downloads/store', [WebDownloadController::class, 'store'])->name('downloads.store_web');
