<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Thống kê cơ bản
            $totalProducts = Product::count();
            $totalCustomers = Customer::count();

            // Xử lý orders an toàn
            $ordersData = $this->getOrdersData();

            // Lấy 5 sản phẩm mới nhất
            $products = Product::with('category')->latest()->take(5)->get();

            $data = array_merge([
                'totalProducts' => $totalProducts,
                'totalCustomers' => $totalCustomers,
                'products' => $products,
                'newReviews' => 0,
                'recentActivities' => []
            ], $ordersData);

            return view('admin.dashboard', $data);
        } catch (\Exception $e) {
            // Fallback data nếu có lỗi
            $data = [
                'totalProducts' => Product::count(),
                'newOrders' => 0,
                'totalCustomers' => Customer::count(),
                'monthlyRevenue' => 0,
                'products' => Product::with('category')->latest()->take(5)->get(),
                'completedOrders' => 0,
                'pendingOrders' => 0,
                'cancelledOrders' => 0,
                'newReviews' => 0,
                'recentActivities' => []
            ];

            return view('admin.dashboard', $data);
        }
    }

    private function getOrdersData()
    {
        $defaultData = [
            'newOrders' => 0,
            'monthlyRevenue' => 0,
            'completedOrders' => 0,
            'pendingOrders' => 0,
            'cancelledOrders' => 0
        ];

        // Kiểm tra bảng orders có tồn tại không
        if (!DB::getSchemaBuilder()->hasTable('orders')) {
            return $defaultData;
        }

        try {
            // Lấy tất cả orders nếu không có cột status
            $totalOrders = Order::count();

            // Kiểm tra các cột tồn tại
            $hasStatus = DB::getSchemaBuilder()->hasColumn('orders', 'status');
            $hasTotalAmount = DB::getSchemaBuilder()->hasColumn('orders', 'total_amount');
            $hasCreatedAt = DB::getSchemaBuilder()->hasColumn('orders', 'created_at');

            if ($hasStatus) {
                // Nếu có cột status
                return [
                    'newOrders' => Order::where('status', 'pending')->count(),
                    'completedOrders' => Order::where('status', 'completed')->count(),
                    'pendingOrders' => Order::where('status', 'pending')->count(),
                    'cancelledOrders' => Order::where('status', 'cancelled')->count(),
                    'monthlyRevenue' => $hasTotalAmount && $hasCreatedAt ?
                        Order::whereMonth('created_at', now()->month)->sum('total_amount') : 0
                ];
            } else {
                // Nếu không có cột status
                return [
                    'newOrders' => $totalOrders,
                    'completedOrders' => $totalOrders,
                    'pendingOrders' => $totalOrders,
                    'cancelledOrders' => 0,
                    'monthlyRevenue' => $hasTotalAmount ? Order::sum('total_amount') : 0
                ];
            }
        } catch (\Exception $e) {
            return $defaultData;
        }
    }
}