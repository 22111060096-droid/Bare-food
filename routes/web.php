<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CalorieController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminUserController;

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

// Customer-facing routes
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{slug}', [MenuController::class, 'show'])->name('menu.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [CartController::class, 'checkoutForm'])->name('checkout.form');
Route::post('/checkout', [CartController::class, 'checkoutSubmit'])->name('checkout.submit');

Route::get('/calories', [CalorieController::class, 'index'])->name('calories.index');
Route::post('/calories/calc', [CalorieController::class, 'calculate'])->name('calories.calculate');

Route::get('/membership', [MembershipController::class, 'index'])->name('membership.index');

Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'index'])->name('account.index');
    Route::get('/account/orders/{order}', [AccountController::class, 'showOrder'])->name('account.orders.show');
});

Route::get('/about', [StaticPageController::class, 'about'])->name('static.about');
Route::get('/stores', [StaticPageController::class, 'stores'])->name('static.stores');
Route::get('/contact', [StaticPageController::class, 'contact'])->name('static.contact');
Route::get('/policy', [StaticPageController::class, 'policy'])->name('static.policy');
Route::get('/faq', [StaticPageController::class, 'faq'])->name('static.faq');

// Simple auth routes (login/register/logout)
Route::get('/login', [AccountController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AccountController::class, 'login']);
Route::post('/logout', [AccountController::class, 'logout'])->name('logout');
Route::get('/register', [AccountController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AccountController::class, 'register']);

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('products', AdminProductController::class);
    Route::resource('categories', AdminCategoryController::class)->except(['show']);
    Route::resource('orders', AdminOrderController::class)->only(['index', 'show', 'update']);
    Route::resource('users', AdminUserController::class)->only(['index', 'show', 'update']);

    Route::post('users/{user}/toggle-admin', [AdminUserController::class, 'toggleAdmin'])->name('users.toggle-admin');
});
