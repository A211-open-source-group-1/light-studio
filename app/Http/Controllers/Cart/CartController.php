<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\PhoneDetails;
use Illuminate\Support\Facades\Auth;
use App\Providers\CurrentCart;
use App\Providers\ProductInCart;

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
                $product = new ProductInCart($item->phone_details_id, $item->parentPhoneDetails->parentPhone->phone_name . ' ' . $item->parentPhoneDetails->parentSpecific->specific_name . ' ' . $item->parentPhoneDetails->parentColor->color_name, $item->quantity, $item->parentPhoneDetails->price, $item->parentPhoneDetails->discount, "img");
                $currentCart->AddToCart($product);
            }
        }
        $prodsInCart = $currentCart->GetProducts();
        return view('cart.cart', compact('prodsInCart'));
    }

    public function addToCart($details_id) {
            $item = PhoneDetails::find($details_id)->first();
            // if not logged in. be a guest
            if (!Auth::check()) {
                if (!session('guestCart', 'default') != 'default') {
                    session(['guestCart' => new CurrentCart()]);
                }
                if (session('guestCart', 'default') != 'default') {
                    $currentCart = session('guestCart');
                    $product = new ProductInCart($item->phone_details_id, $item->parentPhone->phone_name . ' ' . $item->parentSpecific->specific_name . ' ' . $item->parentColor->color_name, 1, $item->price, $item->discount, "img");
                    $currentCart->AddToCart($product);
                    session(['guestCart' => $currentCart]);
                    return $details_id;
                }
                else {
                    return null;
                }
            } else { // if logged in. be a real fucking user :D
                $item = PhoneDetails::find($details_id)->first();
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
                return $details_id;
            }
    }
}
