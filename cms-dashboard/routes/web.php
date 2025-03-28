<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductTagController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ContentTypeController;

use App\Http\Middleware\APIAccess;
use App\Http\Middleware\SetLocale;
use App\Http\Middleware\CheckIfAuthenticated;
use App\Http\Middleware\RedirectIfAuthenticated;

Route::match(['get', 'post'], '/verification/{encryptedId}', [UserController::class, 'verification'])->name('verification');
Route::match(['get', 'post'], '/sign-up', [UserController::class, 'sign_up'])->name('sign-up');

Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::match(['get', 'post'], '/', [AuthController::class, 'login'])->name('login');
    Route::match(['get', 'post'], '/reset', [AuthController::class, 'reset'])->name('reset');
});

Route::middleware([CheckIfAuthenticated::class])->group(function () {
    Route::get('/set-locale/{locale}', function (Request $request, $locale) {
        if (in_array($locale,[
            'en_US', // English (United States)
            'id_ID', // Indonesian (Indonesia)
            'es_ES', // Spanish (Spain)
            'it_IT', // Italian (Italy)
            'fr_FR', // French (France)
            'de_DE', // German (Germany)
            'ja_JP', // Japanese (Japan)
            'ms_MY', // Malay (Malaysia)
        ])) { // supported languages
            Log::info("Setting locale to => " . $locale);
            // Session::save(['locale'=>$locale]);
            // Log::info("session locale to => " .  Session::get('locale'));
            $request->session()->put('locale', $locale); // Set session locale
        }
        return redirect()->back();
    })->name('lang.switch');
    
    Route::middleware([SetLocale::class])->group(function () {

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Import Export
        Route::get('/download/template/{type}', [ExcelController::class, 'download'])->name('download.template');
        Route::get('/import', [ExcelController::class, 'index'])->name('import');
    
        // Order
        Route::get('/dashboard/order-view', [OrderController::class, 'view'])->name('order.view');
        Route::get('/dashboard/get-order-data-AJAX', [OrderController::class, 'get_order_data_AJAX'])->name('order.ajax');
        Route::post('/dashboard/order-detail', [OrderController::class, 'detail'])->name('order.detail');
        Route::post('/dashboard/order-verify', [OrderController::class, 'update_order_status'])->name('order.verify');
        
        // Payment Method
        Route::get('/dashboard/paymentmethod-view', [PaymentMethodController::class, 'view'])->name('paymentmethod.view');
    
        Route::get('/dashboard/paymentmethod-add', [PaymentMethodController::class, 'add'])->name('paymentmethod.add');
        Route::post('/dashboard/paymentmethod-add', [PaymentMethodController::class, 'create'])->name('paymentmethod.create');
    
        Route::get('/dashboard/paymentmethod-edit/{id}', [PaymentMethodController::class, 'edit'])->name('paymentmethod.edit');
        Route::put('/dashboard/paymentmethod-edit/{id}', [PaymentMethodController::class, 'update'])->name('paymentmethod.update');
    
        Route::delete('/dashboard/paymentmethod-delete/{id}', [PaymentMethodController::class, 'delete'])->name('paymentmethod.delete');
    
        // Product
        Route::get('/dashboard/product-view', [ProductController::class, 'view'])->name('product.view');
        Route::get('/dashboard/get-product-data-AJAX', [ProductController::class, 'get_product_data_AJAX'])->name('product.ajax');

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
        
        // Product Tag
        Route::post('/fetch-tags', [ProductTagController::class, 'fetchTags'])->name('tags.fetch');
        
        Route::get('/dashboard/producttag-view', [ProductTagController::class, 'view'])->name('producttag.view');
    
        Route::get('/dashboard/producttag-add', [ProductTagController::class, 'add'])->name('producttag.add');
        Route::post('/dashboard/producttag-add', [ProductTagController::class, 'create'])->name('producttag.create');
    
        Route::get('/dashboard/producttag-edit/{id}', [ProductTagController::class, 'edit'])->name('producttag.edit');
        Route::put('/dashboard/producttag-edit/{id}', [ProductTagController::class, 'update'])->name('producttag.update');
    
        Route::delete('/dashboard/producttag-delete/{id}', [ProductTagController::class, 'delete'])->name('producttag.delete');
    
        // Diskon
        Route::get('/dashboard/discount-view', [DiscountController::class, 'view'])->name('discount.view');
    
        Route::get('/dashboard/discount-add', [DiscountController::class, 'add'])->name('discount.add');
        Route::post('/dashboard/discount-add', [DiscountController::class, 'create'])->name('discount.create');
    
        Route::get('/dashboard/discount-edit/{id}', [DiscountController::class, 'edit'])->name('discount.edit');
        Route::put('/dashboard/discount-edit/{id}', [DiscountController::class, 'update'])->name('discount.update');
    
        Route::delete('/dashboard/producttag-delete/{id}', [ProductTagController::class, 'delete'])->name('producttag.delete');
    
        // Product Supply
        Route::get('/dashboard/supply-view', [SupplyController::class, 'view'])->name('supply.view');
    
        Route::get('/dashboard/supply-add', [SupplyController::class, 'add'])->name('supply.add');
        Route::post('/dashboard/supply-add', [SupplyController::class, 'create'])->name('supply.create');
    
        Route::get('/dashboard/supply-edit/{id}', [SupplyController::class, 'edit'])->name('supply.edit');
        Route::put('/dashboard/supply-edit/{id}', [SupplyController::class, 'update'])->name('supply.update');
    
        Route::delete('/dashboard/supply-delete/{id}', [SupplyController::class, 'delete'])->name('supply.delete');

        // Section
        Route::get('/dashboard/section-view', [SectionController::class, 'view'])->name('section.view');
    
        Route::get('/dashboard/section-add', [SectionController::class, 'add'])->name('section.add');
        Route::post('/dashboard/section-add', [SectionController::class, 'create'])->name('section.create');
    
        Route::get('/dashboard/section-edit/{id}', [SectionController::class, 'edit'])->name('section.edit');
        Route::put('/dashboard/section-edit/{id}', [SectionController::class, 'update'])->name('section.update');
    
        Route::delete('/dashboard/section-delete/{id}', [SectionController::class, 'delete'])->name('section.delete');
        
        // Media
        Route::get('/dashboard/media-view', [MediaController::class, 'view'])->name('media.view');
    
        Route::get('/dashboard/media-add', [MediaController::class, 'add'])->name('media.add');
        Route::post('/dashboard/media-add', [MediaController::class, 'create'])->name('media.create');
    
        Route::get('/dashboard/media-edit/{id}', [MediaController::class, 'edit'])->name('media.edit');
        Route::put('/dashboard/media-edit/{id}', [MediaController::class, 'update'])->name('media.update');
    
        Route::delete('/dashboard/media-delete/{id}', [MediaController::class, 'delete'])->name('media.delete');

        // Link
        Route::get('/dashboard/link-view', [LinkController::class, 'view'])->name('link.view');
    
        Route::get('/dashboard/link-add', [LinkController::class, 'add'])->name('link.add');
        Route::post('/dashboard/link-add', [LinkController::class, 'create'])->name('link.create');
    
        Route::get('/dashboard/link-edit/{id}', [LinkController::class, 'edit'])->name('link.edit');
        Route::put('/dashboard/link-edit/{id}', [LinkController::class, 'update'])->name('link.update');
    
        Route::delete('/dashboard/link-delete/{id}', [LinkController::class, 'delete'])->name('link.delete');
    
        // Content Type
        Route::get('/dashboard/contenttype-view', [ContentTypeController::class, 'view'])->name('contenttype.view');
    
        Route::get('/dashboard/contenttype-add', [ContentTypeController::class, 'add'])->name('contenttype.add');
        Route::post('/dashboard/contenttype-add', [ContentTypeController::class, 'create'])->name('contenttype.create');
    
        Route::get('/dashboard/contenttype-edit/{id}', [ContentTypeController::class, 'edit'])->name('contenttype.edit');
        Route::put('/dashboard/contenttype-edit/{id}', [ContentTypeController::class, 'update'])->name('contenttype.update');
    
        Route::delete('/dashboard/contenttype-delete/{id}', [ContentTypeController::class, 'delete'])->name('contenttype.delete');
    
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

});