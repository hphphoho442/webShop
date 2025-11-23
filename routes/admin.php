<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashBoard;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::middleware(['auth', 'role:admin'])->
    prefix('admin')->
    group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'DashboardManager'])->name('admin.Dashboard');
    Route::get('/accountManager', [AdminDashboardController::class, 'AccountManager'])->name('admin.Account');
});
