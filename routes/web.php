<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\InventoryController;

use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CategoryClientController;
use App\Http\Controllers\Client\ProductClientController;
use App\Http\Controllers\Client\AboutController;
use App\Http\Controllers\Client\PostController;
use App\Http\Controllers\Client\BrandClientController;
use App\Http\Controllers\Client\OrderClientController;
use App\Http\Controllers\Client\UserClientController;
use App\Http\Controllers\Client\ShippingAddressController;

use Illuminate\Support\Facades\Route;

/*
|----------------------------------------------------------------------
| CLIENT ROUTES
|----------------------------------------------------------------------
*/

// Order chi tiết
Route::get('/orders/{id}', [OrderClientController::class, 'show'])->name('client.orders.show');

// Xem sản phẩm theo danh mục
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
Route::get('/cart', [CartController::class, 'show'])->name('cartshow');
Route::get('/cartcheckout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/save', [CartController::class, 'save'])->name('cart.save');

// Routes sản phẩm phía client
Route::prefix('products')->name('client.products.')->group(function () {
    Route::get('/', [ProductClientController::class, 'index'])->name('index');
    Route::get('/detail/{id}', [ProductClientController::class, 'detail'])->name('detail');
    Route::get('/search', [ProductClientController::class, 'search'])->name('search');
    Route::get('/new-products', [ProductClientController::class, 'newProducts'])->name('new'); // fixes products.new
});

// Trang đăng tin cho khách
Route::prefix('posts')->name('posts.')->group(function () {
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/store', [PostController::class, 'store'])->name('store');
});

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

// Khuyến mãi
Route::get('/promotions', function () {
    return view('client.promotions.index');
})->name('promotions.index');

// Route test giao diện client
Route::get('/client', function () {
    return view('layout.client');
})->name('layout.client');

/*
|----------------------------------------------------------------------
| AUTHENTICATION ROUTES
|----------------------------------------------------------------------
*/

// Đăng ký user
Route::get('/admin/create', [UserController::class, 'create'])->name('ad.create');
Route::post('/admin/create', [UserController::class, 'store'])->name('ad.store');

// Đăng nhập CLIENT
Route::get('/login', [UserClientController::class, 'login'])->name('login');
Route::post('/login', [UserClientController::class, 'loginpost'])->name('loginpost');

// Đăng nhập ADMIN
Route::get('/admin/login', [UserController::class, 'login'])->name('ad.login');
Route::post('/admin/login', [UserController::class, 'loginpost'])->name('ad.loginpost');


// Quên mật khẩu
Route::get('/admin/forgotpass', [UserController::class, 'forgotpassform'])->name('ad.forgotpass');
Route::post('/admin/forgotpass', [UserController::class, 'forgotpass'])->name('ad.forgotpasspost');

// Reset mật khẩu
Route::get('/admin/resetpass/{id}', [UserController::class, 'showResetForm'])->name('ad.reset.form');
Route::post('/admin/resetpass/{id}', [UserController::class, 'handleReset'])->name('ad.reset');
Route::middleware(['auth'])->group(function () {
    // Trang hồ sơ người dùng
    Route::get('/account', [UserClientController::class, 'profile'])->name('user.profile');

    // Hiển thị form đặt lại mật khẩu
    Route::get('/account/reset/{id}', [UserClientController::class, 'showResetForm'])->name('user.resetpass');

    // Xử lý đặt lại mật khẩu
    Route::post('/account/reset/{id}', [UserClientController::class, 'handleReset'])->name('user.reset');
});


/*
|----------------------------------------------------------------------
| ADMIN ROUTES (Chỉ admin role = 1)
|----------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['auth']) // CheckAdmin middleware
    ->name('ad.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Customer & Order
        Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
        Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

        // Logout & đổi mật khẩu
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
        Route::get('/changepass', [UserController::class, 'showChangePassForm'])->name('changepass.form');
        Route::post('/changepass', [UserController::class, 'changepass'])->name('changepass');

        // Category Management
        Route::prefix('categories')->name('cate.')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/store', [CategoryController::class, 'store'])->name('store');
            Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
            Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/{category}', [CategoryController::class, 'delete'])->name('delete');
        });

        // Brand Management
        Route::prefix('brands')->name('brand.')->group(function () {
            Route::get('/', [BrandController::class, 'index'])->name('index');
            Route::get('/create', [BrandController::class, 'create'])->name('create');
            Route::post('/store', [BrandController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [BrandController::class, 'edit'])->name('edit');
            Route::post('/{id}', [BrandController::class, 'update'])->name('update');
            Route::post('/{id}/delete', [BrandController::class, 'delete'])->name('delete');
        });

        // Product Management
        // Product Management
        Route::prefix('products')->name('pro.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('/store', [ProductController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ProductController::class, 'update'])->name('update');
            Route::delete('/{id}', [ProductController::class, 'delete'])->name('delete');
        });

        // User Management
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

        // Inventory Management
        Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
    });

// routes/web.php

// routes/web.php

Route::middleware(['auth'])->prefix('profile')->group(function () {
    // Quản lý địa chỉ giao hàng - Client
    Route::get('/shipping-addresses', [ShippingAddressController::class, 'index'])->name('client.shipping-addresses.index');
    Route::get('/shipping-addresses/create', [ShippingAddressController::class, 'create'])->name('client.shipping-addresses.create');
    Route::post('/shipping-addresses', [ShippingAddressController::class, 'store'])->name('client.shipping-addresses.store');
    Route::get('/shipping-addresses/{shippingAddress}/edit', [ShippingAddressController::class, 'edit'])->name('client.shipping-addresses.edit');
    Route::put('/shipping-addresses/{shippingAddress}', [ShippingAddressController::class, 'update'])->name('client.shipping-addresses.update');
    Route::delete('/shipping-addresses/{shippingAddress}', [ShippingAddressController::class, 'destroy'])->name('client.shipping-addresses.destroy');
    Route::post('/shipping-addresses/{shippingAddress}/set-default', [ShippingAddressController::class, 'setDefault'])->name('client.shipping-addresses.set-default');
});
// routes/web.php