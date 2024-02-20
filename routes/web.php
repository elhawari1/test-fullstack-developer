<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'indexLogin')->name('login');
    Route::post('/login/proses', 'loginProses')->name('loginProses');
    Route::get('/logout', 'logout')->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/', 'indexAdmin')->name('admin');
        Route::get('/paket', 'indexPaket');
        Route::get('/customer', 'indexCustomer')->name('customer');
    });
});
