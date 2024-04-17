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
use ExceptionTest;

class CartController extends Controller
{
    public function index(Request $request) {
        $currentCart = new CurrentCart();
        if (!Auth::check()) {
            if ($request->session()->has('guestCart')) {
                $currentCart = $request->session()->get('guestCart');
            }
        }
        else {
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
    public function onActionProduct($details_id, $action) {
        $currentCart = new CurrentCart();
        if (!Auth::check()) {
            if (session('guestCart', 'default') == 'default') {
                session(['guestCart' => new CurrentCart()]);
            }
            else {
                $currentCart = session('guestCart');
            }
        }
        else {
            $carts = Cart::all()->where('user_id', '=', Auth::user()->id);
            foreach ($carts as $item) {
                $product = new ProductInCart($item->phone_details_id, $item->parentPhoneDetails->parentPhone->phone_name . ' ' . $item->parentPhoneDetails->parentSpecific->specific_name . ' ' . $item->parentPhoneDetails->parentColor->color_name, $item->quantity, $item->parentPhoneDetails->price, $item->parentPhoneDetails->discount,$item->parentPhoneDetails->thumbnail_img);
                $currentCart->AddToCart($product);
            }
        }
        foreach ($currentCart->GetProducts() as $item) {
            if ($item->GetId() == $details_id) {
                $cart = null;
                if (Auth::check()) {
                    $cart = Cart::where('user_id', '=', Auth::user()->id)->where('phone_details_id', '=', $details_id)->first();
                }
                if ($action == 'increase') {
                    $item->IncreaseQuantity(1);
                    if ($cart != null) {
                        $cart->update([
                            'quantity' => $item->GetQuantity()
                        ]);
                    }
                } else if ($action == 'decrease') {
                    $item->DecreaseQuantity(1);
                    if ($cart != null) {
                        $cart->update([
                            'quantity' => $item->GetQuantity()
                        ]);
                    }
                } else if ($action == 'delete') {
                    $currentCart->Remove($details_id);
                    if ($cart != null) {
                        $cart->delete();
                    }
                }
            }
        }
        $prodsInCart = $currentCart->GetProducts();
        return response(view('ajax.cartdata', compact('prodsInCart'))->render());
    }

    public function addToCart($details_id) {
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
                $cart = Cart::where('user_id', '=', Auth::user()->id)->where('phone_details_id', '=', $details_id)->first();
                if ($cart != null) {
                    $cart->update([
                        'quantity' => $cart->quantity + 1
                    ]);
                }
                else {
                    $newItemInCart = new Cart();
                    $newItemInCart->user_id = Auth::user()->id;
                    $newItemInCart->phone_details_id = $details_id;
                    $newItemInCart->quantity = 1;
                    $newItemInCart->save();
                }
                return response()->json([
                    'success' => true
                ]);
            }
         
    }
    public function proccedOrder($paymentMethod)
    {
        if(!Auth::check())
        {
            return "đăng nhập vô cu ơi";
        }
        else{
            $currentCart = new CurrentCart();
            $carts = Cart::all()->where('user_id', '=', Auth::user()->id);
            foreach ($carts as $item) {
                $product = new ProductInCart($item->phone_details_id, $item->parentPhoneDetails->parentPhone->phone_name . ' ' . $item->parentPhoneDetails->parentSpecific->specific_name . ' ' . $item->parentPhoneDetails->parentColor->color_name, $item->quantity, $item->parentPhoneDetails->price, $item->parentPhoneDetails->discount, $item->parentPhoneDetails->thumbnail_img);
                $currentCart->AddToCart($product);
            }
            $prodsInCart = $currentCart->GetProducts();         
            return response(view('ajax.cartcheckout', compact('prodsInCart'))->render());
        }
    }
}
