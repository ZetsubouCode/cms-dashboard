<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('sign-in');
});
Route::get('/dashboard', function () {
    return view('dashboard/index');
});

//Payment
Route::get('/dashboard/payment-view', function () {
    return view('dashboard/payment/payment-view');
});
Route::get('/dashboard/paymentmethhod-add', function () {
    return view('dashboard/payment/paymentmethod-view');
});
Route::post('/dashboard/paymentmethhod-add', function () {
    return view('dashboard/payment/paymentmethod-view');
});
Route::get('/dashboard/paymentmethhod-update', function () {
    return view('dashboard/payment/paymentmethod-view');
});
Route::put('/dashboard/paymentmethhod-update', function () {
    return view('dashboard/payment/paymentmethod-view');
});
Route::delete('/dashboard/paymentmethhod-delete', function () {
    return view('dashboard/payment/paymentmethod-view');
});
