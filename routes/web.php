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
use App\Http\Controllers\Client\PostController; // thêm use cho PostController
use App\Http\Controllers\Client\BrandClientController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Client\OrderClientController;

/*
|--------------------------------------------------------------------------
| CLIENT ROUTES (Public routes)
|--------------------------------------------------------------------------
*/

Route::get('/orders/{id}', [OrderClientController::class, 'show'])
    ->name('client.orders.show');

// Quản lý tồn kho






// Xem tất cả sản phẩm (Client)
Route::get('/category/{id}', [CategoryClientController::class, 'detail'])->name('category');


// Load thêm sản phẩm (ajax)
Route::get('/load-more-products', [ProductClientController::class, 'loadMore'])->name('products.loadMore');

// About pages
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/about/team', [AboutController::class, 'team'])->name('about.team');
Route::get('/about/contact', [AboutController::class, 'contact'])->name('about.contact');

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('homepage');

// Giỏ hàng
Route::post('/cartadd/{id}', [CartController::class, 'add'])->name('cartadd');
Route::delete('/cartdel/{id}', [CartController::class, 'del'])->name('cartdel');



// ⚠️ trước là return view, giờ đổi thành controller để đúng chuẩn
Route::get('/cart', [CartController::class, 'show'])->name('cartshow');
Route::get('/cartcheckout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/save', [CartController::class, 'save'])->name('cart.save');

// Routes sản phẩm phía client
Route::prefix('products')->name('client.products.')->group(function () {
    Route::get('/', [ProductClientController::class, 'index'])->name('index');
    Route::get('/detail/{id}', [ProductClientController::class, 'detail'])->name('detail');
    Route::get('/search', [ProductClientController::class, 'search'])->name('search');
});

// Route test giao diện client (có thể xóa nếu không cần)
Route::get('/client', function () {
    return view('layout.client');
})->name('layout.client');


// Trang đăng tin cho khách (nên dùng posts thay vì post để chuẩn RESTful)
Route::prefix('posts')->name('posts.')->group(function () {
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/store', [PostController::class, 'store'])->name('store');
});
// Trang khuyến mãi
Route::get('/promotions', function () {
    return view('client.promotions.index');
})->name('promotions.index');
// Sản phẩm mới
Route::get('/new-products', [App\Http\Controllers\Client\ProductClientController::class, 'newProducts'])
    ->name('products.new');
// Thương hiệu
Route::prefix('brands')->name('client.brands.')->group(function () {
    Route::get('/', [BrandClientController::class, 'index'])->name('index');
    Route::get('/{id}', [BrandClientController::class, 'show'])->name('show');
});
// Payment routes
Route::get('/payment/bank/{order_id}', [CartController::class, 'bank'])->name('payment.bank');
Route::get('/payment/momo/{order_id}', [CartController::class, 'momo'])->name('payment.momo');
Route::get('/payment/vnpay/{order_id}', [CartController::class, 'vnpay'])->name('payment.vnpay');

// Order success
Route::get('/order/success/{order_id}', [CartController::class, 'success'])->name('order.success');





/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES (Login, Register, Password reset)
|--------------------------------------------------------------------------
*/

// Đăng ký user
Route::get('/admin/create', [UserController::class, 'create'])->name('ad.create');
Route::post('/admin/create', [UserController::class, 'store'])->name('ad.store');

// Đăng nhập
Route::get('/admin/login', [UserController::class, 'login'])->name('ad.login');
Route::post('/admin/login', [UserController::class, 'loginpost'])->name('ad.loginpost');
Route::get('/login', [UserController::class, 'login'])->name('login');

// Quên mật khẩu
Route::get('/admin/forgotpass', [UserController::class, 'forgotpassform'])->name('ad.forgotpass');
Route::post('/admin/forgotpass', [UserController::class, 'forgotpass'])->name('ad.forgotpasspost');

// Reset mật khẩu
Route::get('/admin/resetpass/{id}', [UserController::class, 'showResetForm'])->name('ad.reset.form');
Route::post('/admin/resetpass/{id}', [UserController::class, 'handleReset'])->name('ad.reset');
// Trang tài khoản (profile) cho user thường
Route::get('/account', [UserController::class, 'profile'])
    ->name('user.profile')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (Cần đăng nhập mới vào được)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('auth')->name('ad.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Customer & Order
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

    // Logout & đổi mật khẩu
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/changepass', [UserController::class, 'showChangePassForm'])->name('changepass.form');
    Route::post('/changepass', [UserController::class, 'changepass'])->name('changepass');


    // Category Management (chỉ role 1 mới vào được)
    Route::name('cate.')->middleware(RoleMiddleware::class . ':1')->group(function () {
        Route::get('/categories', [CategoryController::class, 'index'])->name('index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/categories/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('update');

        Route::delete('/categories/{category}', [CategoryController::class, 'delete'])->name('delete');
    });


    // Brand Management (chỉ role 1 mới vào được)
    Route::name('brand.')->middleware(RoleMiddleware::class . ':1')->group(function () {
        Route::get('/brands', [BrandController::class, 'index'])->name('index');         // brand.index
        Route::get('/brands/create', [BrandController::class, 'create'])->name('create'); // brand.create
        Route::post('/brands/store', [BrandController::class, 'store'])->name('store');   // brand.store
        Route::get('/brands/{id}/edit', [BrandController::class, 'edit'])->name('edit');  // brand.edit
        Route::post('/brands/{id}', [BrandController::class, 'update'])->name('update');  // brand.update
        Route::post('/brands/{id}/delete', [BrandController::class, 'delete'])->name('delete'); // brand.delete
    });


    // Product Management
    // Product Management
    Route::middleware('auth')->group(function () {
        Route::get('/products', [ProductController::class, 'index'])->name('pro.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('pro.create');
        Route::post('/products/store', [ProductController::class, 'store'])->name('pro.store');
        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('pro.edit');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('pro.update');
        Route::delete('/products/{id}', [ProductController::class, 'delete'])->name('pro.delete');
    });



    // User Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

    // Inventory Management
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
});