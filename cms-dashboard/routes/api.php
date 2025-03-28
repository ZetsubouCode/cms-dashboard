<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrderController;

use App\Http\Middleware\APIAccess;

Route::middleware([APIAccess::class])->group(function () {
        Route::get('/order/get-by-reference-code/{reference_code}', [OrderController::class, 'get_by_reference_code']);
        Route::put('/order/update-by-reference-code', [OrderController::class, 'update_by_reference_code']);
});
Route::get('/test-route', function () {
        return 'Route is working';
    });