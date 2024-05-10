<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\PhoneDetails;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\Auth;
use App\Providers\CurrentCart;
use App\Providers\ProductInCart;
use Illuminate\Support\Facades\Session;
use App\Exception;
use App\Models\User;
use ExceptionTest;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $currentCart = new CurrentCart();
        if (!Auth::check()) {
            if ($request->session()->has('guestCart')) {
                $currentCart = $request->session()->get('guestCart');
            }
        } else {
            $carts = Cart::all()->where('user_id', '=', Auth::user()->id);
            foreach ($carts as $item) {
                $product = new ProductInCart($item->phone_details_id, $item->parentPhoneDetails->parentPhone->phone_name . ' ' . $item->parentPhoneDetails->parentSpecific->specific_name . ' ' . $item->parentPhoneDetails->parentColor->color_name, $item->quantity, $item->parentPhoneDetails->price, $item->parentPhoneDetails->discount, $item->parentPhoneDetails->thumbnail_img);
                $currentCart->AddToCart($product);
            }
        }
        $prodsInCart = $currentCart->GetProducts();
        return view('cart.cart', compact('prodsInCart'));
    }
    public function indexCart()
    {

    }
    public function onActionProduct($details_id, $action)
    {
        $currentCart = new CurrentCart();
        if (!Auth::check()) {
            if (session('guestCart', 'default') == 'default') {
                session(['guestCart' => new CurrentCart()]);
            } else {
                $currentCart = session('guestCart');
            }
        } else {
            $carts = Cart::all()->where('user_id', '=', Auth::user()->id);
            foreach ($carts as $item) {
                $product = new ProductInCart($item->phone_details_id, $item->parentPhoneDetails->parentPhone->phone_name . ' ' . $item->parentPhoneDetails->parentSpecific->specific_name . ' ' . $item->parentPhoneDetails->parentColor->color_name, $item->quantity, $item->parentPhoneDetails->price, $item->parentPhoneDetails->discount, $item->parentPhoneDetails->thumbnail_img);
                $currentCart->AddToCart($product);
            }
        }
        foreach ($currentCart->GetProducts() as $item) {
            if ($item->GetId() == $details_id) {
                $cart = null;
                $details = PhoneDetails::where('phone_details_id', '=', $details_id)->first();
                if (Auth::check()) {
                    $cart = Cart::where('user_id', '=', Auth::user()->id)->where('phone_details_id', '=', $details_id)->first();
                }
                if ($action == 'increase') {
                    if ($details->quantity > 1) {
                        $details->update([
                            'quantity' => $details->quantity - 1
                        ]);
                        $item->IncreaseQuantity(1);
                        if ($cart != null) {
                            $cart->update([
                                'quantity' => $item->GetQuantity()
                            ]); 
                        }
                    }
                } else if ($action == 'decrease' && $item->GetQuantity() > 1) {
                    $details->update([
                        'quantity' => $details->quantity + 1
                    ]);
                    $item->DecreaseQuantity(1);
                    if ($cart != null) {
                        $cart->update([
                            'quantity' => $item->GetQuantity()
                        ]); 
                    }
                } else if ($action == 'delete') {
                    $details->update([
                        'quantity' => $details->quantity + $item->GetQuantity()
                    ]);
                    $currentCart->Remove($details_id);
                    if ($cart != null) {
                        $cart->delete();
                    }
                }
            }
        }
        $prodsInCart = $currentCart->GetProducts();
        return response(view('cart.cart', compact('prodsInCart'))->render());
    }

    public function addToCart($details_id)
    {
        // if not logged in. be a guest
        $item = PhoneDetails::where('phone_details_id', '=', $details_id)->first();
        if (!Auth::check()) {
            if (session('guestCart', 'default') == 'default') {
                session(['guestCart' => new CurrentCart()]);
            }
            $currentCart = session('guestCart');
            $product = new ProductInCart($item->phone_details_id, $item->parentPhone->phone_name . ' ' . $item->parentSpecific->specific_name . ' ' . $item->parentColor->color_name, 1, $item->price, $item->discount, $item->thumbnail_img);
            $currentCart->AddToCart($product);
            session(['guestCart' => $currentCart]);

            return response()->json([
                'success' => true
            ]);
        } else {
            if ($item->quantity > 1) {
                $cart = Cart::where('user_id', '=', Auth::user()->id)->where('phone_details_id', '=', $details_id)->first();
                if ($cart != null) {
                    $cart->update([
                        'quantity' => $cart->quantity + 1
                    ]);
                } else {
                    $newItemInCart = new Cart();
                    $newItemInCart->user_id = Auth::user()->id;
                    $newItemInCart->phone_details_id = $details_id;
                    $newItemInCart->quantity = 1;
                    $newItemInCart->save();
                }
                $item->update([
                    'quantity' => $item->quantity - 1
                ]);
                return response()->json([
                    'success' => true
                ]);
            }
        }
    }
    public function proceedOrder(Request $request)
    {
        if (!Auth::check()) {
            return "đăng nhập vô cu ơi";
        } else {
            $new_order = new Order();
            $new_order->user_id = Auth::user()->id;
            $new_order->status_id = 1;
            switch ($request->paymentMethod) {
                case 'cod': {
                    $new_order->payment_method_id = 1;
                    break;
                }
                case 'visa': {
                    break;
                }
                case 'paypal': {
                    break;
                }
                case 'vnpay': {
                    break;
                }
            }
            $new_order->order_date = date('Y-m-d H:i:s');
            if ($request->addressType == 'currentAddress') {
                $new_order->order_address = Auth::user()->address;
            } else {
                $new_order->order_address = $request->new_address;
            }
            $new_order->save();
            $user = User::where('id', '=', Auth::user()->id)->first();
            $carts = $user->Carts();
            $total_price = 0;
            foreach ($carts as $item) {
                $new_order_details = new OrderDetails();
                $new_order_details->order_id = $new_order->order_id;
                $new_order_details->phone_details_id = $item->phone_details_id;
                $new_order_details->order_quantity = $item->quantity;
                $new_order_details->total_price = ($item->price - $item->discount) * $item->quantity;
                $total_price = $total_price + ($item->price - $item->discount) * $item->quantity;
                $new_order_details->save();
            }
            $new_order->update([
                'order_total_price' => $total_price
            ]);
            $carts->delete();
        }
        return view('cart.thankyou');
    }
}
