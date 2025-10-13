<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        // THAY ĐỔI TỪ:
        // $customers = Customer::all();
        // HOẶC:
        // $customers = Customer::get();

        // THÀNH:
        $customers = Customer::with('orders')->paginate(10); // 10 items per page

        return view('admin.customers.index', compact('customers'));
    }
}