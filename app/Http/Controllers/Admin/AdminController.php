<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function Index(){
        return view('admin.index');
    }
    public function Dashboard(Request $request)
    {
        // ===== DATE RANGE =====
        $from = $request->get('from', now()->startOfMonth()->toDateString());
        $to   = $request->get('to', now()->toDateString());

        // ===== REVENUE (chỉ đơn hoàn tất) =====
        $totalRevenue = Order::where('status', 'completed')
            ->whereBetween('created_at', [
                $from . ' 00:00:00',
                $to . ' 23:59:59'
            ])
            ->sum('total_amount');

        // ===== TOTAL ORDERS =====
        $totalOrders = Order::whereBetween('created_at', [
                $from . ' 00:00:00',
                $to . ' 23:59:59'
            ])->count();

        // ===== ORDERS BY STATUS =====
        $ordersByStatus = Order::select('status', DB::raw('COUNT(*) as total'))
            ->whereBetween('created_at', [
                $from . ' 00:00:00',
                $to . ' 23:59:59'
            ])
            ->groupBy('status')
            ->pluck('total', 'status');

        // ===== USERS BY ROLE =====
        $usersByRole = User::select('role', DB::raw('COUNT(*) as total'))
            ->groupBy('role')
            ->pluck('total', 'role');

        return view('admin.dashboard.index', compact(
            'totalRevenue',
            'totalOrders',
            'ordersByStatus',
            'usersByRole',
            'from',
            'to'
        ));
    }
}
