<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\ProdukLokasiController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukByStaffController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\StaffLokasiController;

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

Route::get('/test', function() {
    return response()->json(['message' => 'API works']);
});

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', RoleMiddleware::class . ':Admin'])->group(function () {
    Route::apiResource('produks', ProdukController::class);
    Route::apiResource('kategoris', KategoriController::class);
    Route::apiResource('satuans', SatuanController::class);
    Route::apiResource('lokasis', LokasiController::class);
    Route::apiResource('produk-lokasis', ProdukLokasiController::class);
    Route::apiResource('mutasis', MutasiController::class);
    Route::apiResource('users', UserController::class);
    Route::get('/produk/{id}/mutasi', [MutasiController::class, 'historyByProduk']);
    Route::get('/user/{id}/mutasi', [MutasiController::class, 'historyByUser']);
    Route::post('/lokasi/assign-staff', [StaffLokasiController::class, 'store']);
    Route::get('/lokasi/{id}/staffs', [StaffLokasiController::class, 'getStaffByLokasi']);
});

Route::middleware(['auth:sanctum', RoleMiddleware::class . ':Staff'])->group(function () {
    Route::apiResource('stafflokasi', ProdukByStaffController::class);
    Route::post('/mutasi', [MutasiController::class, 'storeByStaff']);
    Route::get('/mutasi', [MutasiController::class, 'indexByStaff']);
});