<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Page\PageController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Cart\CartController;

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
Route::get('', [PageController::class, 'index']);
Route::get('page/AboutUs', [PageController::class, 'aboutus'])->name('aboutus');
Route::get('phone/{phone_id}/detail/{detail_id}/specs/{specs_id}', [ProductController::class, 'detail']);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('product/brand/{brand_id}', [ProductController::class, 'products'])->name('products');
Route::get('Auth/info', [AuthController::class, 'User_info'])->name('user.info');
Route::post('/update', [AuthController::class, 'update'])->name('update');
Route::get('Change/Password', [AuthController::class, 'ChangePassword'])->name('ChangePassword');
Route::post('/handleChangePassword',[AuthController::class,'handleChangePassword'])->name('handleChangePassword');
Route::get('identify',[AuthController::class,'identify'])->name('identify');
Route::post('findNumberPhone',[AuthController::class,'findNumberPhone'])->name('findNumberPhone');
Route::get('cart', [CartController::class, 'index'])->name('cart');