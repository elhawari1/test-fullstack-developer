<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('/login', [AuthController::class, 'loginProses']);
Route::controller(AuthController::class)->group(function () {
    Route::get('/sales', 'getRoleSales');
    Route::post('/storesales', 'storeSales');
    Route::post('/updatesales/{id}', 'updateSales');
    Route::post('/deletesale/{id}', 'deleteSales');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/paket', 'getDataPaket');
    Route::post('/storepaket', 'storePaket');
    Route::post('/updatepaket/{id_paket}', 'updatePaket');
    Route::post('/deletepaket/{id_paket}', 'deletePaket');
});

Route::controller(CustomerController::class)->group(function () {
    Route::get('/customer', 'getDataCustomer');
    Route::get('/customershow/{id_customer}', 'show');
    Route::post('/storecustomer', 'store');
    Route::post('/updatecustomer/{id_customer}', 'update');
    Route::post('/deletecustomer/{id_customer}', 'delete');
});