<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolePermissionController;

use App\Http\Middleware\CheckIfAuthenticated;
use App\Http\Middleware\RedirectIfAuthenticated;

Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::match(['get', 'post'], '/', [AuthController::class, 'login'])->name('login');
    Route::match(['get', 'post'], '/reset', [AuthController::class, 'reset'])->name('reset');
});

Route::middleware([CheckIfAuthenticated::class])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Payment
    Route::get('/dashboard/payment-view', [PaymentController::class, 'view'])->name('payment.view');
    Route::get('/dashboard/payment-detail', [PaymentController::class, 'detail'])->name('payment.detail');

    // Payment Method
    Route::get('/dashboard/paymentmethod-view', [PaymentMethodController::class, 'view'])->name('paymentmethod.view');

    Route::get('/dashboard/paymentmethod-add', [PaymentMethodController::class, 'add'])->name('paymentmethod.add');
    Route::post('/dashboard/paymentmethod-add', [PaymentMethodController::class, 'create'])->name('paymentmethod.create');

    Route::get('/dashboard/paymentmethod-edit/{id}', [PaymentMethodController::class, 'edit'])->name('paymentmethod.edit');
    Route::put('/dashboard/paymentmethod-edit/{id}', [PaymentMethodController::class, 'update'])->name('paymentmethod.update');

    Route::delete('/dashboard/paymentmethod-delete/{id}', [PaymentMethodController::class, 'delete'])->name('paymentmethod.delete');

    // Product
    Route::get('/dashboard/product-view', [ProductController::class, 'view'])->name('product.view');

    Route::get('/dashboard/product-add', [ProductController::class, 'add'])->name('product.add');
    Route::post('/dashboard/product-add', [ProductController::class, 'create'])->name('product.create');

    Route::get('/dashboard/product-edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/dashboard/product-edit/{id}', [ProductController::class, 'update'])->name('product.update');

    Route::delete('/dashboard/product-delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

    // Product Category
    Route::get('/dashboard/productcategory-view', [ProductCategoryController::class, 'view'])->name('productcategory.view');

    Route::get('/dashboard/productcategory-add', [ProductCategoryController::class, 'add'])->name('productcategory.add');
    Route::post('/dashboard/productcategory-add', [ProductCategoryController::class, 'create'])->name('productcategory.create');

    Route::get('/dashboard/productcategory-edit/{id}', [ProductCategoryController::class, 'edit'])->name('productcategory.edit');
    Route::put('/dashboard/productcategory-edit/{id}', [ProductCategoryController::class, 'update'])->name('productcategory.update');

    Route::delete('/dashboard/productcategory-delete/{id}', [ProductCategoryController::class, 'delete'])->name('productcategory.delete');

    // Product Supply
    Route::get('/dashboard/supply-view', [SupplyController::class, 'view'])->name('supply.view');

    Route::get('/dashboard/supply-add', [SupplyController::class, 'add'])->name('supply.add');
    Route::post('/dashboard/supply-add', [SupplyController::class, 'create'])->name('supply.create');

    Route::get('/dashboard/supply-edit/{id}', [SupplyController::class, 'edit'])->name('supply.edit');
    Route::put('/dashboard/supply-edit/{id}', [SupplyController::class, 'update'])->name('supply.update');

    Route::delete('/dashboard/supply-delete/{id}', [SupplyController::class, 'delete'])->name('supply.delete');

    // User
    Route::get('/dashboard/user-view', [UserController::class, 'view'])->name('user.view');

    Route::get('/dashboard/user-add', [UserController::class, 'add'])->name('user.add');
    Route::post('/dashboard/user-add', [UserController::class, 'create'])->name('user.create');

    Route::get('/dashboard/user-edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/dashboard/user-edit/{id}', [UserController::class, 'update'])->name('user.update');

    Route::delete('/dashboard/user-delete/{id}', [UserController::class, 'delete'])->name('user.delete');

    // Role & Permission
    Route::get('/dashboard/rolepermission-view', [RolePermissionController::class, 'view'])->name('rolepermission.view');

    Route::get('/dashboard/rolepermission-add', [RolePermissionController::class, 'add'])->name('rolepermission.add');
    Route::post('/dashboard/rolepermission-add', [RolePermissionController::class, 'create'])->name('rolepermission.create');

    Route::get('/dashboard/rolepermission-edit/{id}', [RolePermissionController::class, 'edit'])->name('rolepermission.edit');
    Route::put('/dashboard/rolepermission-edit/{id}', [RolePermissionController::class, 'update'])->name('rolepermission.update');

    Route::delete('/dashboard/rolepermission-delete/{id}', [RolePermissionController::class, 'delete'])->name('rolepermission.delete');
});