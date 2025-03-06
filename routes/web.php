<?php

use App\Livewire\ProductCategoriesComponent;
use App\Livewire\ProductComponent;
use App\Livewire\Admin\ProductComponent as AdminProductComponent;
// use App\Livewire\Admin\CategoryComponent as AdminCategoryComponent;

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\TwoFactorAuthController;
use App\Http\Controllers\User\StripePaymentController;
use App\Livewire\Admin\Category\CategoryComponent as AdminCategoryComponent;
use App\Livewire\Admin\Category\SubCategoryComponent as AdminSubCategoryComponent;
use App\Livewire\Admin\Product\Create as AdminProductCreateCompoment;
use App\Livewire\CartComponent;
use App\Livewire\User\CheckoutComponent;
use App\Livewire\ProductDetailComponent;
use App\Livewire\User\HomeComponent;
use App\Livewire\User\OrderComponent;
use App\Livewire\Admin\Order\OrderComponent as AdminOrderComponent;
use App\Livewire\Admin\TwoFactorAuthComponent;
use App\Livewire\Admin\UsersList;
use App\Livewire\User\ProfileComponent;
use App\Models\Category;

// use App\Livewire\CartComponent;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// Route::get('/', function () {
    //     return view('welcome');
    // });
    // Route::group(['middleware' => 'guest'], function () {
    //     Route::get('/register', [AuthController::class, 'register'])->name('register');
    //     Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    //     Route::get('/login', [AuthController::class, 'login'])->name('login');
    //     Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
    // });
    // Route::group(['middleware' => 'auth'], function () {
    //     Route::get('/home', [HomeController::class, 'index']);
    //     Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
    // });

    // Route::get('/dashboard', function () {
    //     return view('dashboard');
// })->name('dashboard');

//Google
// Route::get('/login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
// Route::get('/login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);
// //Facebook
// Route::get('/login/facebook', [App\Http\Controllers\Auth\LoginController::class, 'redirectToFacebook'])->name('login.facebook');
// Route::get('/login/facebook/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleFacebookCallback']);


// Admin Routes
Route::middleware('auth:admin')->group(function () {
    Route::get('admin/2fa/register', [TwoFactorAuthComponent::class, 'render'])->name('admin.2fa.register');
    Route::post('admin/2fa/register', [TwoFactorAuthComponent::class, 'enableTwoFactorAuth'])->name('admin.2fa.register');
    Route::get('admin/2fa/verify', [TwoFactorAuthComponent::class, 'verify'])->name('admin.2fa.verify');
    Route::post('admin/2fa/verify', [TwoFactorAuthComponent::class, 'verifyTwoFactorAuth'])->name('admin.2fa.verify');
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth:admin','2fa'])->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard'); // Create a dashboard view
        })->name('admin.dashboard');
        Route::get('/', function () {
            return view('admin.dashboard'); // Create a dashboard view
        })->name('admin');
        Route::get('/users',UsersList::class)->name('admin.users');
        Route::get('/products',AdminProductComponent::class)->name('admin.products');
        Route::get('/product/create',AdminProductCreateCompoment::class)->name('admin.product.create');
        Route::get('/product/edit/{id}', AdminProductCreateCompoment::class)->name('admin.product.edit');
        Route::get('/categories',AdminCategoryComponent::class)->name('admin.categories');
        Route::get('/subcategories',AdminSubCategoryComponent::class)->name('admin.subcategories');
        Route::get('/orders',AdminOrderComponent::class)->name('admin.orders');
        // Route::get('orders/ups/token', [AdminOrderComponent::class, 'getToken']);
    });
});


Route::get('dashboard', HomeComponent::class)->name('dashboard');
Route::get('/', HomeComponent::class)->name('home');
Route::get('/categories/{encrypted}', ProductCategoriesComponent::class)->name('categories.show');
Route::get('/products/{slug}', ProductDetailComponent::class)->name('products.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/products',ProductComponent::class)->name('products');
    Route::get('/profile',ProfileComponent::class)->name('profile');
    ;
    Route::get('/cart', CartComponent::class)->name('cart');
    Route::get('/checkout', CheckoutComponent::class)->name('checkout');
    Route::post('checkout/payment', [CheckoutComponent::class,'checkout'])->name('checkout.payment');

    Route::get('/orders', OrderComponent::class)->name('orders');

});
