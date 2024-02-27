<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DashboardExport;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Barang;

class ReportController extends Controller
{
    public function index()
    {   
        $totalUsers = User::where('utype', 'USR')->count();
        $orderData = OrderDetail::with(['orderItems', 'user'])
            ->where('payment_status', 'paid')
            ->orderBy('created_at', 'desc')
            ->get();
        $totalOrders = $orderData->count();
        $totalRevenue = $orderData->sum('total_harga');

        $groupedOrders = $orderData->groupBy('status');

        return view('dashboard.dashboard', [
            'orderData' => $orderData,
            'totalUsers' => $totalUsers,
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'groupedOrders' => $groupedOrders,
        ]);
    }

    public function exportExcel(Request $request)
    {   
        $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');

    $orderData = OrderDetail::with(['orderItems', 'user'])
        ->where('payment_status', 'paid')
        ->when($start_date, function ($query) use ($start_date) {
            return $query->whereDate('created_at', '>=', Carbon::parse($start_date)->startOfDay());
        })
        ->when($end_date, function ($query) use ($end_date) {
            return $query->whereDate('created_at', '<=', Carbon::parse($end_date)->endOfDay());
        })
        ->orderBy('created_at', 'desc')
        ->get();

    $groupedOrders = $orderData->groupBy('status');

    return Excel::download(new DashboardExport($groupedOrders, $start_date, $end_date), 'laporan-dashboard.xlsx');
    }

}
