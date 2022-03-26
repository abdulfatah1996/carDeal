<?php

use App\Http\Controllers\AgreementController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//administrator
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    //profile
    Route::group(['prefix' => 'profile'], function () {
        Route::get('index', [ProfileController::class, 'index'])->name('profile_index');
        Route::post('update', [ProfileController::class, 'update'])->name('profile_update');
        Route::post('UpdateImg', [ProfileController::class, 'UpdateImg'])->name('profile_UpdateImg');
        Route::post('UpdatePass', [ProfileController::class, 'UpdatePass'])->name('profile_UpdatePass');
        Route::post('destroy', [ProfileController::class, 'destroy'])->name('user_destroy');
    });


    //users
    Route::group(['prefix' => 'users'], function () {
        Route::get('index', [UserController::class, 'index'])->name('users_index');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('users_edit');
        Route::get('destroy/{id}', [UserController::class, 'destroy'])->name('users_destroy');

        Route::post('update', [UserController::class, 'update'])->name('users_update');
    });



    //cars
    Route::group(['prefix' => 'cars'], function () {
        Route::get('index', [CarController::class, 'index'])->name('cars-index');
        Route::get('create', [CarController::class, 'create'])->name('cars-create');
        Route::get('edit/{id}', [CarController::class, 'edit'])->name('cars-edit');
        Route::get('destroy/{id}', [CarController::class, 'destroy'])->name('cars-destroy');

        Route::post('store', [CarController::class, 'store'])->name('cars-store');
        Route::post('update', [CarController::class, 'update'])->name('cars-update');
    });


    //agreement
    Route::group(['prefix' => 'agreement'], function () {
        Route::get('index/{id}', [AgreementController::class, 'index'])->name('agreement-index');
    });
});

//Customer
Route::group(['prefix' => 'customer', 'middleware' => ['auth']], function () {
    //orders
    Route::group(['prefix' => 'order'], function () {
        Route::get('index', [OrderController::class, 'index'])->name('order-index');
        Route::get('create/{id}', [OrderController::class, 'create'])->name('order-create');

        Route::post('store/{id}', [OrderController::class, 'store'])->name('order-store');
        Route::get('update/{id}', [OrderController::class, 'update'])->name('order-update');
    });
});
