<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function DashboardManager(){
        return view('admin.dashboardManager');
    }
    public function AccountManager(){
        $accountList = User::all();
        return view('admin.accountManager', compact('accountList'));
    }
}
