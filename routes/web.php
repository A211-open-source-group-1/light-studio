<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Page\PageController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Cart\OrderController;
use App\Http\Controllers\Management\MProductController;
use App\Http\Controllers\Management\MOrderedCartController;
use App\Http\Controllers\Management\MPhoneCategoryController;
use App\Http\Controllers\Management\MBrandController;
use App\Http\Controllers\Management\MChartController;
use App\Http\Controllers\Management\MEmployeeController;
use App\Http\Controllers\Management\MPostController;
use App\Http\Controllers\Management\MProductImportController;
use App\Http\Controllers\Management\MReviewController;
use App\Http\Controllers\Management\MSliderController;
use App\Http\Controllers\Page\PostController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes(['verify' => true]);

Route::get('', [PageController::class, 'index'])->name('home');
Route::get('page/AboutUs', [PageController::class, 'aboutus'])->name('aboutus');
Route::get('phone/{phone_id}/detail/{detail_id}/specs/{specs_id}', [ProductController::class, 'detail'])->name('detail');
Route::get('product/brand/{brand_id}', [ProductController::class, 'products'])->name('products');
Route::get('product/tablet/brand/{brand_id}', [ProductController::class, 'tablet_products'])->name('tablet_products');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::get('admin', [AuthController::class, 'admin'])->name('adminLogins');

Route::post('search', [ProductController::class, 'search'])->name('search');
Route::get('search', [ProductController::class, 'search'])->name('search');
Route::post('filter', [ProductController::class, 'filter'])->name('filter');
Route::get('filter', [ProductController::class, 'filter'])->name('filter');

Route::get('/user_verify/{token}', [AuthController::class, 'user_verify'])->name('user_verify');
Route::get('/user_verify_request', [AuthController::class, 'user_verify_request'])->name('user_verify_request');
Route::get('/user_reset_password/{token}', [AuthController::class, 'user_reset_password'])->name('user_reset_password');
Route::get('/user_forgot_password_request/{user_id}', [AuthController::class, 'user_forgot_password_request'])->name('user_forgot_password_requests');
Route::get('identify', [AuthController::class, 'identify'])->name('identify');
Route::post('findNumberPhone', [AuthController::class, 'findNumberPhone'])->name('findNumberPhone');
Route::get('resetPassword', [AuthController::class, 'resetPassword'])->name('resetPassword');

Route::middleware('user.logged_in')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('Auth/info', [AuthController::class, 'User_info'])->name('user.info');
    Route::post('/update', [AuthController::class, 'update'])->name('update');
    Route::get('Change/Password', [AuthController::class, 'ChangePassword'])->name('ChangePassword');
    Route::post('/handleChangePassword', [AuthController::class, 'handleChangePassword'])->name('handleChangePassword');
    Route::get('/thankyouforyourorder/{order_id}', [CartController::class, 'thanks'])->name('thanks');
    Route::get('/errors', [CartController::class, 'errors'])->name('errors');
    Route::post('/userRatingProduct', [ProductController::class, 'userRatingProduct'])->name('userRatingProduct');
});

Route::middleware('email.verified')->group(function () {
    Route::get('/orderedCart', [MOrderedCartController::class, 'index'])->name('orderedCart');
    Route::post('/proceedOrder', [CartController::class, 'proceedOrder'])->name('proceedOrder');
    Route::get('cart', [CartController::class, 'index'])->name('cart');
    Route::get('/addToCart/{details_id}', [CartController::class, 'addToCart'])->name('addToCart');
    Route::get('/onActionProduct/{id}/{action}', [CartController::class, 'onActionProduct'])->name('onActionProduct');
    Route::get('/yourOrders', [OrderController::class, 'index'])->name('userOrders');
    Route::get('/cancelOrder/{order_id}', [OrderController::class, 'cancelOrder'])->name('cancelOrder');
});


Route::post('authAdmin', [AuthController::class, 'authAdmin'])->name('authAdmin');

Route::middleware('employee.verified')->group(function () {
    Route::get('logoutAdmin', [AuthController::class, 'logoutAdmin'])->name('logoutAdmin');
    Route::get('customer', [AuthController::class, 'customer'])->name('customer');
    Route::get('indexAdmin', [MChartController::class, 'index'])->name('indexAdmin');
    Route::post('deleteUser', [AuthController::class, 'deleteUser'])->name('deleteUser');
    Route::get('/get-user/{id}', [AuthController::class, 'getUser'])->name('getUser');
    Route::post('edit-user', [AuthController::class, 'editUser'])->name('editUser');

    Route::get('productsIndex/{type}', [MProductController::class, 'index'])->name('productsIndex');
    Route::get('/searchUser/{searchTerm}', [AuthController::class, 'searchUser'])->name('searchUser');

    Route::get('index', [MPhoneCategoryController::class, 'index'])->name('indexCategory');
    Route::get('/listPhoneCategory/{id}', [MPhoneCategoryController::class, 'listPhoneCategory'])->name('listPhoneCategory');
    Route::get('/searchCategory/{searchItem}', [MPhoneCategoryController::class, 'searchCategory'])->name('searchCategory');
    Route::post('addCategory', [MPhoneCategoryController::class, 'addCategory'])->name('addCategory');
    Route::get('brandIndex', [MBrandController::class, 'brandIndex'])->name('brandIndex');
    Route::get('listItemBrand/{id}', [MBrandController::class, 'listItemBrand'])->name('listItemBrand');
    Route::post('addBrand', [MBrandController::class, 'addBrand'])->name('addBrand');
    Route::get('/searchBrand/{term}', [MBrandController::class, 'searchBrand'])->name('searchBrand');
    Route::post('editCategory', [MPhoneCategoryController::class, 'editCategory'])->name('editCategory');
    Route::get('loadModalCategory/{id}', [MPhoneCategoryController::class, 'loadModalCategory'])->name('loadModalCategory');
    Route::get('loadModalBrand/{id}', [MBrandController::class, 'loadModalBrand'])->name('loadModalBrand');
    Route::get('editBrand', [MBrandController::class, 'editBrand'])->name('editBrand');
    Route::post('deleteBrand', [MBrandController::class, 'deleteBrand'])->name('deleteBrand');
    Route::get('/editPhone/{phone_id}', [MProductController::class, 'editPhone'])->name('editPhone');
    Route::post('/editPhoneSubmit', [MProductController::class, 'editPhoneSubmit'])->name('editPhoneSubmit');
    Route::get('/editColors/{phone_id}', [MProductController::class, 'editColors'])->name('editColors');
    
    Route::get('/editSelectedColor/{color_id}', [MProductController::class, 'editSelectedColor'])->name('editSelectedColor');
    Route::POST('/editSelectedColorSubmit', [MProductController::class, 'editSelectedColorSubmit'])->name('editSelectedColorSubmit');
    Route::post('/addColorSubmit', [MProductController::class, 'addColorSubmit'])->name('addColorSubmit');
    Route::get('/deleteColor/{color_id}', [MProductController::class, 'deleteColor'])->name('deleteColor');
    Route::get('/editSpecifics/{phone_id}', [MProductController::class, 'editSpecifics'])->name('editSpecifics');
    Route::get('/editDetails/{phone_id}', [MProductController::class, 'editDetails'])->name('editDetails');
    Route::post('/addSpecificSubmit', [MProductController::class, 'addSpecificSubmit'])->name('addSpecificSubmit');
    Route::post('/editSelectedSpecificSubmit', [MProductController::class, 'editSelectedSpecificSubmit'])->name('editSelectedSpecificSubmit');
    Route::get('/editSelectedSpecific/{specs_id}', [MProductController::class, 'editSelectedSpecific'])->name('editSelectedSpecific');
    Route::get('/deleteSpecific/{specs_id}', [MProductController::class, 'deleteSpecific'])->name('deleteSpecific');
    Route::get('/editSelectedDetails/{details_id}', [MProductController::class, 'editSelectedDetails'])->name('editSelectedDetails');
    Route::post('/editSelectedDetailsSubmit', [MProductController::class, 'editSelectedDetailsSubmit'])->name('editSelectedDetailsSubmit');
    Route::post('/addPhoneDetailsSubmit', [MProductController::class, 'addPhoneDetailsSubmit'])->name('addPhoneDetailsSubmit');
    Route::get('/deleteDetails/{details_id}', [MProductController::class, 'deleteDetails'])->name('deleteDetails');
    Route::get('/addDetails/{phone_id}', [MProductController::class, 'addDetails'])->name('addDetails');
    Route::post('/addPhoneSubmit', [MProductController::class, 'addPhoneSubmit'])->name('addPhoneSubmit');
    Route::get('/addPhone', [MProductController::class, 'addPhone'])->name('addPhone');
    Route::get('/deletePhone/{phone_id}', [MProductController::class, 'deletePhone'])->name('deletePhone');
    Route::get('/importProduct', [MProductImportController::class, 'index'])->name('importProduct');
    Route::get('/showProduct/{order_id}', [MOrderedCartController::class, 'showProduct'])->name('showProduct');
    Route::post('/setProcessingOrder', [MOrderedCartController::class, 'setProcessingOrder'])->name('setProcessingOrder');
    Route::post('/setProceedOrder', [MOrderedCartController::class, 'setProceedOrder'])->name('setProceedOrder');
    Route::post('/setDeliveringOrder', [MOrderedCartController::class, 'setDeliveringOrder'])->name('setDeliveringOrder');
    Route::post('/setReturnOrder', [MOrderedCartController::class, 'setReturnOrder'])->name('setReturnOrder');
    Route::post('/cancelOrder', [MOrderedCartController::class, 'cancelOrder'])->name('cancelOrder');
    Route::post('/addDetailsByCurrentColor', [MProductController::class, 'addDetailsByCurrentColor'])->name('addDetailsByCurrentColor');
    Route::get('/getDetailsList/{phone_id}', [MProductController::class, 'getDetailsList'])->name('getDetailsList');

    Route::get('/getAllDetailsList', [MProductImportController::class, 'getAllDetailsList'])->name('getAllDetailsList');
    Route::post('/addImportReceiptSubmit', [MProductImportController::class, 'addImportReceiptSubmit'])->name('addImportReceiptSubmit');
    Route::post('/deleteImportReceiptSubmit', [MProductImportController::class, 'deleteImportReceiptSubmit'])->name('deleteImportReceiptSubmit');
    Route::get('/printImportReceiptPdf/{receipt_id}', [MProductImportController::class, 'printImportReceiptPdf'])->name('printImportReceiptPdf');

    Route::get('/getRevenueInYear', [MChartController::class, 'getRevenueInYear'])->name('getRevenueInYear');
    Route::get('/getNewAccountsInYear', [MChartController::class, 'getNewAccountsInYear'])->name('getNewAccountsInYear');
    Route::get('/getOrdersInYear', [MChartController::class, 'getOrdersInYear'])->name('getOrdersInYear');
    Route::get('/getOrderReturnedRatioInYear', [MChartController::class, 'getOrderReturnedRatioInYear'])->name('getOrderReturnedRatioInYear');

    // MEmployee
    Route::get('/management/employee', [MEmployeeController::class, 'index'])->name('management_employee');
    Route::get('/get-employee/{id}', [MEmployeeController::class, 'getEmployee'])->name('getEmployee');
    Route::post('editEmployee', [MEmployeeController::class, 'editEmployee'])->name('editEmployee');
    Route::get('/searchEmployee/{searchTerm}', [MEmployeeController::class, 'searchEmployee'])->name('searchEmployee');
    Route::post('deleteEmployee', [MEmployeeController::class, 'deleteEmployee'])->name('deleteEmployee');
    // MPost
    Route::get('/management/post', [MPostController::class, 'index'])->name('management_post');
    Route::get('/management/getpost/{post_id}', [MPostController::class, 'getPost'])->name('management_get_post');
    Route::post('/management/addnewpost', [MPostController::class, 'addNewPost'])->name('management_add_new_post');
    Route::post('/management/editpost', [MPostController::class, 'editPost'])->name('management_edit_post');
    Route::post('/management/deletepost', [MPostController::class, 'deletePost'])->name('management_delete_post');

    // MReview
    Route::get('/management/review', [MReviewController::class, 'index'])->name('management_review');
    Route::post('/management/review/accept', [MReviewController::class, 'acceptReview'])->name('management_accept_review');
    Route::post('/management/review/decline', [MReviewController::class, 'declineReview'])->name('management_decline_review');

    // MSlider
    Route::get('/management/slider', [MSliderController::class, 'index'])->name('management_slider');

});

// PostPage
Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::get('/post/{id}', [PostController::class, 'post'])->name('post');

// Address API
Route::get('/getAllProvinces', [AuthController::class, 'getAllProvinces'])->name('getAllProvinces');
Route::get('/getDistricts/{province_id}', [AuthController::class, 'getDistricts'])->name('getDistricts');
Route::get('/getWards/{district_id}', [AuthController::class, 'getWards'])->name('getWards');