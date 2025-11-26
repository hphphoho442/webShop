<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashBoard;
use App\Http\Controllers\admin\AccountController;
use App\Http\Controllers\Admin\AdminController;

Route::middleware(['auth', 'role:admin'])->
    controller(AdminController::class)->
    prefix('admin')->
    group(function () {
        Route::get('/index',  [AdminController::class, 'Index'])->name('admin.index');
        Route::prefix('accountManager')->
        controller(AccountController::class)->
        group(function(){
            Route::get('/', 'AccountManager')->name('admin.Account');
            Route::get('/create', 'Create')->name('admin.Account.Create');
            Route::POST('/Store', 'Store')->name('admin.Account.Store');
            Route::GET('/update/{id}', 'Update')->name('admin.Account.Update');
            Route::PUT('/update/PUT/{id}', 'UpdatePUT')->name('admin.Account.UpdatePUT');
            Route::GET('/{id}/delete', 'destroy')->name('admin.Account.Delete');
        });
});
