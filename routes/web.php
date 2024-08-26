<?php

use App\Http\Controllers\admin\AccountController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\CheckLogin;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::middleware(CheckLogin::class)->group(function(){

    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::prefix('products')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('products.index');
            Route::get('/create', [ProductController::class, 'create'])->name('products.create');
            Route::post('/create', [ProductController::class, 'store'])->name('products.store');
            Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('products.edit');
            Route::put('/edit/{product}', [ProductController::class, 'update'])->name('products.update');
            Route::delete('/delete/{product}', [ProductController::class, 'destroy'])->name('products.delete');
        });
        Route::prefix('account')->group(function(){
            Route::get('/listAccount', [AccountController::class, 'index'])->name('listAccount');
            Route::get('/createaccount', [AccountController::class, 'create'])->name('createAccount');
            Route::post('/createaccount', [AccountController::class, 'store'])->name('storeAccount');
            Route::patch('/users/{id}/status', [AccountController::class, 'updateStatus'])->name('users.updateStatus');
            Route::delete('/accountDelete/{id}', [AccountController::class, 'delete'])->name('delete');
            Route::get('/editAccount/{id}', [AccountController::class, 'edit'])->name('editAccount');
            Route::put('/editAccount/{id}', [AccountController::class, 'updateAccount'])->name('editAccount.update');
        });
        Route::prefix('brand')->group(function () {
            Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');
            Route::get('/brand/create', [BrandController::class, 'create'])->name('brand.create');
            Route::post('/brand/create', [BrandController::class, 'store'])->name('brand.store');
            Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
            Route::put('/brand/edit/{id}', [BrandController::class, 'update'])->name('brand.update');
            Route::delete('/brand/delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');
        });
    });

    //Client
    // Route::get('/', [HomeController::class, 'index'])->name('page.home');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('category/{category}', [ClientProductController::class, 'list'])->name('page.category.list');
    Route::get('product/{slug}', [ClientProductController::class, 'detail'])->name('page.product.detail');

});

//login
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'postLogin'])->name('postLogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register', [LoginController::class, 'postRegister'])->name('postRegister');
