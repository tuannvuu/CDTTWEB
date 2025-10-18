<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderClientController extends Controller
{
    public function show($id)
    {
        $order = Order::with(['items.product'])->findOrFail($id);
        return view('client.orders.show', compact('order'));
    }
}
