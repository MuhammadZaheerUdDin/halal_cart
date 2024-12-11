<?php

use App\Livewire\ProductComponent;
use App\Livewire\Admin\ProductComponent as AdminProductComponent;
use App\Http\Controllers\AdminAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
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
// Admin Routes

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); // Create a dashboard view
    })->name('admin.dashboard');
    Route::get('admin/products',AdminProductComponent::class)->name('admin.products');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/products',ProductComponent::class);


});

