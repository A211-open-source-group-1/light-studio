<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Page\PageController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Management\MProductController;
use App\Http\Controllers\Management\MOrderedCartController;
use App\Http\Controllers\Management\MPhoneCategoryController;
use App\Http\Controllers\Management\MBrandController;

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
Route::get('product/brand/{brand_id}', [ProductController::class, 'products'])->name('products');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('Auth/info', [AuthController::class, 'User_info'])->name('user.info');
Route::post('/update', [AuthController::class, 'update'])->name('update');
Route::get('Change/Password', [AuthController::class, 'ChangePassword'])->name('ChangePassword');
Route::post('/handleChangePassword',[AuthController::class,'handleChangePassword'])->name('handleChangePassword');
Route::get('identify',[AuthController::class,'identify'])->name('identify');
Route::post('findNumberPhone',[AuthController::class,'findNumberPhone'])->name('findNumberPhone');
Route::get('resetPassword',[AuthController::class,'resetPassword'])->name('resetPassword');

Route::get('cart', [CartController::class, 'index'])->name('cart');
Route::get('/addToCart/{details_id}', [CartController::class, 'addToCart'])->name('addToCart');
Route::get('/onActionProduct/{id}/{action}', [CartController::class, 'onActionProduct'])->name('onActionProduct');
Route::post('search', [ProductController::class, 'search'])->name('search');
Route::get('search', [ProductController::class, 'search'])->name('search');
Route::post('filter', [ProductController::class, 'filter'])->name('filter');
Route::get('filter', [ProductController::class, 'filter'])->name('filter');


Route::get('admin', [AuthController::class, 'admin'])->name('adminLogins');
Route::post('authAdmin',[AuthController::class,'authAdmin'])->name('authAdmin');
Route::get('customer',[AuthController::class,'customer'])->name('customer');
Route::get('indexAdmin',[AuthController::class,'indexAdmin'])->name('indexAdmin');
Route::post('deleteUser',[AuthController::class,'deleteUser'])->name('deleteUser');
Route::get('/get-user/{id}', [AuthController::class, 'getUser'])->name('getUser');
Route::post('edit-user', [AuthController::class, 'editUser'])->name('editUser');
Route::get('productsIndex/{type}', [MProductController::class, 'index'])->name('productsIndex');
Route::get('/searchUser/{searchTerm}',[AuthController::class,'searchUser'])->name('searchUser');
Route::get('/orderedCart',[MOrderedCartController::class,'index'])->name('orderedCart');
Route::get('/proccedOrder/{paymentMethod}',[CartController::class,'proccedOrder'])->name('proccedOrder');
Route::get('index',[MPhoneCategoryController::class,'index'])->name('indexCategory');
Route::get('/listPhoneCategory/{id}',[MPhoneCategoryController::class,'listPhoneCategory'])->name('listPhoneCategory');
Route::get('/searchCategory/{searchItem}',[MPhoneCategoryController::class,'searchCategory'])->name('searchCategory');
Route::post('addCategory',[MPhoneCategoryController::class,'addCategory'])->name('addCategory');
Route::get('brandIndex',[MBrandController::class,'brandIndex'])->name('brandIndex');
Route::get('listItemBrand/{id}',[MBrandController::class,'listItemBrand'])->name('listItemBrand');
Route::post('addBrand',[MBrandController::class,'addBrand'])->name('addBrand');
Route::get('/searchBrand/{term}',[MBrandController::class,'searchBrand'])->name('searchBrand');
Route::post('editCategory',[MPhoneCategoryController::class,'editCategory'])->name('editCategory');
Route::get('loadModalCategory/{id}',[MPhoneCategoryController::class,'loadModalCategory'])->name('loadModalCategory');
Route::get('loadModalBrand/{id}',[MBrandController::class,'loadModalBrand'])->name('loadModalBrand');
Route::get('editBrand',[MBrandController::class,'editBrand'])->name('editBrand');


Route::get('/editPhone/{phone_id}', [MProductController::class, 'editPhone'])->name('editPhone');
Route::post('/editPhoneSubmit', [MProductController::class, 'editPhoneSubmit'])->name('editPhoneSubmit');
Route::get('/editColors/{phone_id}', [MProductController::class, 'editColors'])->name('editColors');
Route::post('/userRatingProduct',[ProductController::class,'userRatingProduct'])->name('userRatingProduct');
Route::get('/editSelectedColor/{color_id}', [MProductController::class, 'editSelectedColor'])->name('editSelectedColor');
Route::POST('/editSelectedColorSubmit', [MProductController::class, 'editSelectedColorSubmit'])->name('editSelectedColorSubmit');
Route::post('/addColorSubmit', [MProductController::class, 'addColorSubmit'])->name('addColorSubmit');
Route::get('/deleteColor/{color_id}', [MProductController::class, 'deleteColor'])->name('deleteColor');
Route::get('/editSpecifics/{phone_id}', [MProductController::class, 'editSpecifics'])->name('editSpecifics');
Route::get('/editDetails/{phone_id}', [MProductController::class, 'editDetails'])->name('editDetails');