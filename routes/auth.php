<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Custom Auth (Admin & User)
Volt::route('admin/login', 'pages.auth.admin-login')
    ->name('login');

Volt::route('admin/register', 'pages.auth.admin-register')
    ->name('register');

Route::middleware('guest')->group(function () {
    Volt::route('forgot-password', 'pages.auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'pages.auth.reset-password')
        ->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'pages.auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirm-password', 'pages.auth.confirm-password')
        ->name('password.confirm');

    // Redirect dashboard based on user role
    Route::get('dashboard', function () {
        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('super-admin')) {
            return redirect('/admin');
        }

        return redirect('/');
    })->name('dashboard');

    Route::post('logout', function () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    })->name('logout');
});
