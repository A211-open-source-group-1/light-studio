<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $allOrders = Order::select('*')
            ->join('users', 'users.id', '=', 'order.user_id')
            ->join('payment_method', 'payment_method.payment_method_id', '=', 'order.payment_method_id')
            ->join('order_status', 'order_status.status_id', '=', 'order.status_id')
            ->where('users.id', '=', Auth::user()->id)
            ->paginate(8, ['*'], 'all');
        return view('cart.orders', compact('allOrders'));
    }

    public function cancelOrder($order_id) {
        if (Auth::check()) {
            $order = Order::where('order_id', '=', $order_id)
            ->first();
            $order->OrderDetails()->delete();
            $order->delete();
        }
        return redirect()->back();
    }
}
