<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashBoard;
use App\Http\Controllers\admin\AccountController;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::middleware(['auth', 'role:admin'])->
    prefix('admin')->
    group(function () {
        Route::get('/index', [AdminDashboardController::class, 'Index'])->name('admin.index');
        Route::get('/accountManager', [AdminDashboardController::class, 'AccountManager'])->name('admin.Account');
        Route::prefix('accountManager')->group(function(){
            Route::get('/create', [AccountController::class, 'Create'])->name('admin.Account.Create');
            Route::POST('/Store', [AccountController::class, 'Store'])->name('admin.Account.Store');
        });
});
