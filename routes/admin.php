<?php

use App\Http\Controllers\Admin\DashBoard;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [DashBoard::class, 'index'])->name('admin.dashboard');
    // Route::get('/admin', [DashBoard::class, 'index']);
});
