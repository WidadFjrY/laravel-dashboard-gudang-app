<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Account
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

// Product
Route::get('/products', [ProductController::class, 'index'])->middleware('auth');
Route::get('/get-product/{id}', [ProductController::class, 'getProduct'])->middleware('auth');
Route::get('/product/create', [ProductController::class, 'createProduct'])->middleware('auth');
Route::get('/product/update/{product:sku}', [ProductController::class, 'updateView'])->middleware('auth');
Route::get('/product-in', [ProductController::class, 'incomingProduct'])->middleware('auth');
Route::get('/product-out', [ProductController::class, 'outgoingProduct'])->middleware('auth');

Route::put('/product/update/{product:sku}/{userId}', [ProductController::class, 'update'])->middleware('auth');
Route::put('/product/update/inc/{product:id}/{userId}', [ProductController::class, 'updateInc'])->middleware('auth');
Route::put('/product/update/del/{product:id}/{userId}', [ProductController::class, 'updateDec'])->middleware('auth');

Route::post('/product/create/{userId}', [ProductController::class, 'store'])->middleware('auth');

Route::delete('/product/delete/{product:id}/{userId}', [ProductController::class, 'destroy'])->middleware('auth');

// Category
Route::get('/categories', [CategoryController::class, 'index'])->middleware('auth');
Route::get('/check-category/{id}', [CategoryController::class, 'checkCategory'])->middleware('auth');
Route::get('/category/{category:slug}', [CategoryController::class, 'showCategoryWithProduct'])->middleware('auth');
Route::get('/get-category/{id}', [CategoryController::class, 'getCategory'])->middleware('auth');

Route::post('/category/create/{userId}', [CategoryController::class, 'store'])->middleware('auth');

Route::delete('/category/delete/{category:id}/{userId}', [CategoryController::class, 'destroy'])->middleware('auth');

Route::put('/category/update/{category:id}/{userId}', [CategoryController::class, 'update'])->middleware('auth');

// Unit
Route::get('/get-unit/{id}', [UnitController::class, 'getUnit'])->middleware('auth');
Route::get('/check-unit/{id}', [UnitController::class, 'checkUnit'])->middleware('auth');
Route::get('/units', [UnitController::class, 'index'])->middleware('auth');
Route::get('/unit/{unit:slug}', [UnitController::class, 'showUnitWithProduct'])->middleware('auth');

Route::post('/unit/create/{userId}', [UnitController::class, 'store'])->middleware('auth');

Route::delete('/unit/delete/{unit:id}/{userId}', [UnitController::class, 'destroy'])->middleware('auth');

Route::put('/unit/update/{unit:id}/{userId}', [UnitController::class, 'update'])->middleware('auth');


// User
Route::get('/users', [UserController::class, 'index'])->middleware('auth');
Route::get('/get-user/{id}', [UserController::class, 'getUser'])->middleware('auth');
Route::get('/user/create', [UserController::class, 'createUser'])->middleware('auth');
Route::get('/user/update/{user:username}', [UserController::class, 'updateUser'])->middleware('auth');

Route::post('/user/create/{userId}', [UserController::class, 'store'])->middleware('auth');

Route::delete('/user/delete/{user:id}/{userId}', [UserController::class, 'destroy'])->middleware('auth');

Route::put('/user/update/{user:id}/{userId}', [UserController::class, 'update'])->middleware('auth');

Route::get('/reports', [ReportController::class, 'index'])->middleware('auth');
Route::get('/report/{year}/{month}', [ReportController::class, 'show'])->middleware('auth');

// History
Route::get('/histories', [HistoryController::class, 'index'])->middleware('auth');
Route::delete('/histories', [HistoryController::class, 'destroy'])->middleware('auth');
