<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function Index(){
        return view('admin.index');
    }
    public function DashboardManager(){
        return view('admin.dashboardManager');
    }
}
