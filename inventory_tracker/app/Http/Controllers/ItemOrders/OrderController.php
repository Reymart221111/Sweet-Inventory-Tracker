<?php

namespace App\Http\Controllers\ItemOrders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('contents.admin.orders.index');
    }

    public function showOrderDetails(Order $order)
    {
        $viewing = true;
        return view('contents.admin.orders.index', compact('viewing', 'order'));
    }
}
