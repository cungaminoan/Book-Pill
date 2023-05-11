<?php

use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\StatisticalController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaserController;
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
    if((Auth::check() && Auth::user()->role == 2) || (!Auth::check())) {
        return redirect()->route('product.main');
    } else {
        return redirect()->route('admin.product.list');
    }
})->name('main');

Route::get('/register', function () {
    if (!Auth::check()) {
        return view('pages.auth.register');
    }

    return redirect()->route('main');
})->name('register');

Route::post('/register_page', [UserController::class, 'register'])->name('register_user');
Route::post('/register', [UserController::class, 'registerUser'])->name('register_user_req');

Route::get('/sign-in', [UserController::class, 'index'])->name('sign_in');
Route::post('/sign-in', [UserController::class, 'login'])->name('request_sign_in');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/reset', [UserController::class, 'resetPassword'])->name('reset');
Route::post('/reset', [UserController::class, 'resetPasswordRequest'])->name('reset.request');
Route::get('/verify', [UserController::class, 'verifyEmail'])->name('verify.email');
Route::get('/reset/password', [UserController::class, 'resetPasswordIndex'])->name('reset.password');

Route::middleware('user')->group(function () {
    Route::prefix('/account')->name('account.')->group(function () {
        Route::get('/profile', function () {
            return view('pages.profile.profile');
        })->name('profile');
        Route::post('change', [UserController::class, 'changeUser'])->name('change');
        Route::get('/cart', [CartController::class, 'getCartList'])->name('cart');
        Route::post('/cart', [CartController::class, 'addProductToCart'])->name('add_cart');
        Route::post('/cart/remove', [CartController::class, 'removeProductFromCart'])->name('remove_product');
        Route::get('/order', [OrderController::class, 'getOrder'])->name('order');
        Route::post('/order/tmp', [OrderController::class, 'createOrderTmp'])->name('creat_order_tmp');
        Route::post('/order/create', [OrderController::class, 'createOrder'])->name('create_order');
        Route::get('/purchaser', [PurchaserController::class, 'getPurchaser'])->name('purchaser');
        Route::post('/comment/add', [CommentController::class, 'addCommentProduct'])->name('add_comment');
    });
});

Route::middleware('userAndGuest')->group(function () {
    Route::prefix('/product')->name('product.')->group(function () {
        Route::get('/', [ProductController::class, 'getProductList'])->name('main');
        Route::get('/search', [ProductController::class, 'getProductBySearchKey'])->name('search');
        Route::get('/detail', [ProductController::class, 'getProductDetail'])->name('detail');
        Route::post('/filter', [ProductController::class, 'getProductFilter'])->name('filter');
        Route::post('/title', [ProductController::class, 'getProductTitle'])->name('title');
        Route::post('/comment/get', [CommentController::class, 'getCommentProduct'])->name('get_comment');
        Route::get('/genre', [ProductController::class, 'getProductByGenre'])->name('genre');
        Route::get('/author', [ProductController::class, 'getProductByAuthor'])->name('author');
    });

    Route::get('/error', function () {
        return view('pages.error.error');
    })->name('error');
});

Route::middleware('admin')->group(function () {
    Route::prefix('/admin')->name('admin.')->group(function () {
        Route::prefix('/product')->name('product.')->group(function () {
            Route::get('/add', [AdminProductController::class, 'getProductAdd'])->name('add');
            Route::post('/add', [AdminProductController::class, 'addProduct'])->name('post_add');
            Route::get('/list', [AdminProductController::class, 'getProductList'])->name('list');
            Route::get('/detail', [AdminProductController::class, 'getProductDetail'])->name('detail');
            Route::get('/edit', [AdminProductController::class, 'getProductEdit'])->name('edit');
            Route::post('/edit', [AdminProductController::class, 'editProduct'])->name('post_edit');
        });
        Route::prefix('/user')->name('user.')->group(function () {
            Route::get('/list', [AdminUserController::class, 'getUserList'])->name('list');
            Route::get('/detail', [AdminUserController::class, 'getUserDetail'])->name('detail');
            Route::post('/change', [AdminUserController::class, 'changeUserStatus'])->name('change_status');
        });
        Route::prefix('/statistical')->name('statistical.')->group(function () {
            Route::get('/main', [StatisticalController::class, 'getStatisticalProduct'])->name('main');
            Route::post('calculate', [StatisticalController::class, 'calculateStatisticalProduct'])->name('calculate');
        });
        Route::prefix('/order')->name('order.')->group(function () {
            Route::get('/list', [AdminOrderController::class, 'getOrderList'])->name('list');
            Route::get('/detail', [AdminOrderController::class, 'getOrderDetail'])->name('detail');
            Route::post('/handle', [AdminOrderController::class, 'handleOrder'])->name('handle');
        });
    });
});
