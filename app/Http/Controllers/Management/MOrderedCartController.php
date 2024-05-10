<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;

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
        $processingOrdersCount = Order::select('*')->where('status_id', '=', 1)->count();
        return view('admin.orderedCart.orderedCart', compact('processingOrders', 'proceedOrders', 'deliveringOrders', 'deliveredOrders', 'allOrders', 'processingOrdersCount'));
    }

    public function showProduct($order_id) {
        $orderDetails = OrderDetails::select('*')
        ->join('phone_details', 'order_details.phone_details_id', '=', 'phone_details.phone_details_id')
        ->where('order_details.order_id', '=', $order_id)
        ->get();
        return response()->json($orderDetails);
    }
}
