<?php

use App\Http\Controllers\api\v1\auth\AuthController;
use App\Http\Controllers\api\v1\master\MasterKendaraanController;
use App\Http\Controllers\api\v1\sales\OrderController;
use App\Http\Controllers\api\v1\sales\StockController;
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


Route::prefix('v1')->group(function () {
    Route::prefix('/account')->group(function () {
        Route::post('authenticate', [AuthController::class,'authenticate'])->name('auth.authenticate');
    });

    Route::group(['middleware' => ['jwt.auth']], static function () {
        Route::prefix('/account')->group(function () {
            Route::post('register', [AuthController::class,'register'])->name('auth.register');
        });
        Route::prefix('/master')->group(function () {
            Route::prefix('/vehicle')->group(function () {
                Route::post('store', [MasterKendaraanController::class,'store'])->name('master.vehicle.store');
            });
        });
        Route::prefix('/transaction')->group(function () {
            Route::prefix('/order')->group(function () {
                Route::post('store', [OrderController::class,'store'])->name('transaction.order.store');
            });

            Route::prefix('/stock')->group(function () {
                Route::post('store', [StockController::class,'store'])->name('transaction.stock.store');
            });
        });

    });


});


