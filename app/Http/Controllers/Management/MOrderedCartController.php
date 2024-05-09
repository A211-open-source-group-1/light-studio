<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;

class MOrderedCartController extends Controller
{
    //
    public function index()
    {
        $allOrders = Order::select('*')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->join('payment_method', 'payment_method.payment_method_id', '=', 'order.payment_method_id')
            ->join('order_status', 'order_status.status_id', '=', 'order.status_id')
            ->paginate(1, ['*'], 'all');
        $processingOrders = Order::select('*')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->join('payment_method', 'payment_method.payment_method_id', '=', 'order.payment_method_id')
            ->join('order_status', 'order_status.status_id', '=', 'order.status_id')
            ->where('order_status.status_id', '=', 1)
            ->paginate(1, ['*'], 'processing');
        $proceedOrders = Order::select('*')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->join('payment_method', 'payment_method.payment_method_id', '=', 'order.payment_method_id')
            ->join('order_status', 'order_status.status_id', '=', 'order.status_id')
            ->where('order_status.status_id', '=', 2)
            ->paginate(1, ['*'], 'proceed');
        $deliveringOrders = Order::select('*')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->join('payment_method', 'payment_method.payment_method_id', '=', 'order.payment_method_id')
            ->join('order_status', 'order_status.status_id', '=', 'order.status_id')
            ->where('order_status.status_id', '=', 3)
            ->paginate(1, ['*'], 'delivering');
        $deliveredOrders = Order::select('*')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->join('payment_method', 'payment_method.payment_method_id', '=', 'order.payment_method_id')
            ->join('order_status', 'order_status.status_id', '=', 'order.status_id')
            ->where('order_status.status_id', '=', 4)
            ->paginate(1, ['*'], 'delivered');
        return view('admin.orderedCart.orderedCart', compact('processingOrders', 'proceedOrders', 'deliveringOrders', 'deliveredOrders', 'allOrders'));
    }
}
