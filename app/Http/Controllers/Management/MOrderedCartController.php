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
            ->paginate(12, ['*'], 'all');
        $processingOrders = Order::select('*')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->join('payment_method', 'payment_method.payment_method_id', '=', 'order.payment_method_id')
            ->join('order_status', 'order_status.status_id', '=', 'order.status_id')
            ->where('order_status.status_id', '=', 1)
            ->paginate(12, ['*'], 'processing');
        $proceedOrders = Order::select('*')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->join('payment_method', 'payment_method.payment_method_id', '=', 'order.payment_method_id')
            ->join('order_status', 'order_status.status_id', '=', 'order.status_id')
            ->where('order_status.status_id', '=', 2)
            ->paginate(12, ['*'], 'proceed');
        $deliveringOrders = Order::select('*')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->join('payment_method', 'payment_method.payment_method_id', '=', 'order.payment_method_id')
            ->join('order_status', 'order_status.status_id', '=', 'order.status_id')
            ->where('order_status.status_id', '=', 3)
            ->paginate(12, ['*'], 'delivering');
        $deliveredOrders = Order::select('*')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->join('payment_method', 'payment_method.payment_method_id', '=', 'order.payment_method_id')
            ->join('order_status', 'order_status.status_id', '=', 'order.status_id')
            ->where('order_status.status_id', '=', 4)
            ->paginate(12, ['*'], 'delivered');
        $processingOrdersCount = Order::select('*')->where('status_id', '=', 1)->count();
        return view('admin.orderedCart.orderedCart', compact('processingOrders', 'proceedOrders', 'deliveringOrders', 'deliveredOrders', 'allOrders', 'processingOrdersCount'));
    }

    public function showProduct($order_id)
    {
        $orderDetails = OrderDetails::select('*')
            ->join('phone_details', 'order_details.phone_details_id', '=', 'phone_details.phone_details_id')
            ->where('order_details.order_id', '=', $order_id)
            ->get();
        return response()->json($orderDetails);
    }

    public function setProcessingOrder(Request $request)
    {
        $order = Order::where('order_id', '=', $request->order_id)
            ->first();
        $order->update([
            'status_id' => 2
        ]);
        return response()->json(['test' => true]);
    }

    public function setProceedOrder(Request $request)
    {
        $order = Order::where('order_id', '=', $request->order_id)
            ->first();
        $order->update([
            'status_id' => 3
        ]);
        return response()->json(['test' => true]);
    }

    public function setDeliveringOrder(Request $request)
    {
        $order = Order::where('order_id', '=', $request->order_id)
            ->first();
        $order->update([
            'status_id' => 4
        ]);
        return response()->json($request);
    }

    public function setReturnOrder(Request $request) {

    }

    public function cancelOrder(Request $request) {

    }
}
