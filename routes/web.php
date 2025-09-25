<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Client\CategoryClientController;
use App\Http\Controllers\Client\ProductClientController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\Client\AboutController;
use App\Http\Controllers\Client\PostController;
use App\Http\Controllers\Admin\ChangePasswordController;

/*
|--------------------------------------------------------------------------
| CLIENT ROUTES (Public routes)
|--------------------------------------------------------------------------
*/

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('homepage');

// Category & Products
Route::get('/category/{id}', [CategoryClientController::class, 'detail'])->name('category');
Route::get('/load-more-products', [ProductClientController::class, 'loadMore'])->name('products.loadMore');
Route::prefix('products')->name('client.products.')->group(function () {
    Route::get('/', [ProductClientController::class, 'index'])->name('index');
    Route::get('/detail/{id}', [ProductClientController::class, 'detail'])->name('detail');
    Route::get('/search', [ProductClientController::class, 'search'])->name('search');
});

// Giỏ hàng
Route::post('/cartadd/{id}', [CartController::class, 'add'])->name('cartadd');
Route::get('/cartdel/{id}', [CartController::class, 'del'])->name('cartdel');
Route::post('/cartsave', [CartController::class, 'save'])->name('cartsave');
Route::get('/cartshow', [CartController::class, 'show'])->name('cartshow');
Route::get('/cartcheckout', function () {
    return view('client.cart.checkout');
})->name('checkout');

// About pages
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/about/team', [AboutController::class, 'team'])->name('about.team');
Route::get('/about/contact', [AboutController::class, 'contact'])->name('about.contact');

// Posts (client)
Route::prefix('posts')->name('posts.')->group(function () {
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/store', [PostController::class, 'store'])->name('store');
});


/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Login, Register, Forgot/Reset Password)
|--------------------------------------------------------------------------
*/

// Đăng ký & đăng nhập
Route::get('/admin/create', [UserController::class, 'create'])->name('ad.create');
Route::post('/admin/create', [UserController::class, 'store'])->name('ad.store');
Route::get('/admin/login', [UserController::class, 'login'])->name('ad.login');
Route::post('/admin/login', [UserController::class, 'loginpost'])->name('ad.loginpost');
Route::get('/login', [UserController::class, 'login'])->name('login');

// Quên & reset mật khẩu
Route::get('/admin/forgotpass', [UserController::class, 'forgotpassform'])->name('ad.forgotpass');
Route::post('/admin/forgotpass', [UserController::class, 'forgotpass'])->name('ad.forgotpasspost');
Route::get('/admin/resetpass/{id}', [UserController::class, 'showResetForm'])->name('ad.reset.form');
Route::post('/admin/resetpass/{id}', [UserController::class, 'handleReset'])->name('ad.reset');

// Đổi mật khẩu
Route::get('/admin/change-password', [UserController::class, 'showChangeForm'])
    ->name('ad.changepass.form')
    ->middleware('auth');
Route::post('/admin/change-password', [UserController::class, 'changePassword'])
    ->name('ad.changepass.update')
    ->middleware('auth');


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (Cần đăng nhập)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('ad.dashboard');

    // Logout
    Route::post('/logout', [UserController::class, 'logout'])->name('ad.logout');

    // Customers & Orders
    Route::get('/customers', [CustomerController::class, 'index'])->name('ad.customers.index');
    Route::get('/orders', [OrderController::class, 'index'])->name('ad.orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('ad.orders.show');

    // Categories (role 1) - Sửa tên route thành cate.index
    Route::prefix('categories')->name('cate.')->middleware(RoleMiddleware::class . ':1')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::post('/{id}', [CategoryController::class, 'update'])->name('update');
        Route::post('/{id}/delete', [CategoryController::class, 'delete'])->name('delete');
    });

    // Brands (role 1) - Sửa tên route thành brand.index
    Route::prefix('brands')->name('brand.')->middleware(RoleMiddleware::class . ':1')->group(function () {
        Route::get('/', [BrandController::class, 'index'])->name('index');
        Route::get('/create', [BrandController::class, 'create'])->name('create');
        Route::post('/store', [BrandController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [BrandController::class, 'edit'])->name('edit');
        Route::post('/{id}', [BrandController::class, 'update'])->name('update');
        Route::post('/{id}/delete', [BrandController::class, 'delete'])->name('delete');
    });

    // Products
    Route::prefix('products')->name('ad.pro.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ProductController::class, 'update'])->name('update');
        Route::post('/{id}/delete', [ProductController::class, 'delete'])->name('delete');
    });

    // Users (role 1)
    Route::prefix('users')->name('ad.users.')->middleware(RoleMiddleware::class . ':1')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');           // danh sách user
        Route::get('/create', [UserController::class, 'create'])->name('create');  // form thêm user
        Route::post('/store', [UserController::class, 'store'])->name('store');    // lưu user mới
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');   // form sửa
        Route::put('/{id}', [UserController::class, 'update'])->name('update');    // cập nhật
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy'); // xóa
    });
});