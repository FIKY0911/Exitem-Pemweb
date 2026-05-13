<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/browse/{category:slug}', [FrontController::class, 'category'])->name('front.category');
Route::get('/browse/{product:slug}', [FrontController::class, 'details'])->name('front.details');

Route::post('/order/begin/{product:slug}', [OrderController::class, 'saveOrder'])->name('front.save_order');
Route::get('/order/booking/', [OrderController::class, 'booking'])->name('front.booking');

Route::get('/order/booking/customer-data', [OrderController::class, 'customerData'])->name('front.customer_data');
Route::post('/order/booking/customer-data/save', [OrderController::class, 'saveCustomerData'])->name('front.save_customer_data');

Route::get('/order/payment', [OrderController::class, 'payment'])->name('front.payment');
Route::post('/order/payment/confirm', [OrderController::class, 'paymentConfirm'])->name('front.payment_confirm');
Route::get('/order/finished/{productTransaction:id}', [OrderController::class, 'orderFinished'])->name('front.order_finished');

Route::middleware('auth')->group(function () {
    // Consolidated profile route with role-based redirection
    Route::get('/profile', function () {
        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('super-admin')) {
            return redirect('/admin/profile');
        }

        return app(UserController::class)->profile(request());
    })->name('profile');

    // Role-specific groups for other routes
    Route::middleware('user')->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    });

    Route::middleware('admin')->group(function () {
        // Additional admin routes can go here
    });
});

require __DIR__.'/auth.php';
