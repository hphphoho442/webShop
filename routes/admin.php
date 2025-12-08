<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashBoard;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\admin\AccountController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SupplierController;
use App\Http\Controllers\admin\CategoriesController;

Route::middleware(['auth', 'role:admin'])->
    controller(AdminController::class)->
    name('admin.')->
    prefix('admin')->
    group(function () {
        Route::get('/index',  [AdminController::class, 'Index'])->name('index');
        Route::prefix('accountManager')->
        name('Account.')->
        controller(AccountController::class)->
        group(function(){
            Route::GET('/', 'AccountManager')->name('index');
            Route::GET('/create', 'Create')->name('Create');
            Route::POST('/Store', 'Store')->name('Store');
            Route::GET('/update/{id}', 'Update')->name('Update');
            Route::PUT('/update/PUT/{id}', 'UpdatePUT')->name('UpdatePUT');
            Route::GET('/{id}/delete', 'destroy')->name('Delete');
        });
        Route::prefix('categories')->
        controller(CategoriesController::class)->
        name('categories.')->
        group(function(){
            Route::GET('/', 'index')->name('index');
            Route::GET('/create', 'create')->name('create');
            Route::GET('/updateCategory/{id}', 'update')->name('update');
            Route::POST('/createPOST', 'CreatePOST')->name('CreatePOST');
            Route::PUT('/UpdatePUT/{id}', 'UpdatePUT')->name('UpdatePUT');
            Route::GET('/{id}/delete', 'Destroy')->name('Delete');
        });
        Route::prefix('product')->
        controller(ProductController::class)->
        name('product.')->
        group(function(){
            Route::GET('/', 'index')->name('index');
            Route::GET('/create', 'create')->name('create');
            Route::GET('/search', 'search')->name('search');
        });
        Route::prefix('supplier')->
        controller(SupplierController::class)->
        name('supplier.')->
        group(function(){
            Route::GET('/', 'index')->name('index');
            Route::GET('/create', 'create')->name('create');
            Route::POST('/createPOST', 'createPOST')->name('createPOST');
            Route::GET('/update/{id}', 'update')->name('update');
            Route::PUT('/updatePUT/{id}', 'updatePUT')->name('updatePUT');
            Route::GET('/{id}/delete', 'Delete')->name('delete');
        });
});
