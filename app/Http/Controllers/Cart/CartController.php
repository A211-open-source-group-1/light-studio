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
            $carts = Cart::all()->where('id', '=', Auth::user()->id);
            foreach ($carts as $item) {
                $product = new ProductInCart($item->phone_details_id, $item->parentPhone->phone_name . $item->parentPhoneDetails->parentSpecific->specific_name . $item->parentPhoneDetails->parentColor->color_name, $item->quantity, $item->parentDetails->price, $item->parentDetails->discount, "img");
                $currentCart->AddToCart($product);
            }
        }
        $prodsInCart = $currentCart->GetProducts();
        return view('cart.cart', compact('prodsInCart'));
    }

    public function addToCart($details_id) {
        if (!Auth::check()) {
            if (!session('guestCart', 'default') != 'default') {
                session(['guestCart' => new CurrentCart()]);
            }
            if (session('guestCart', 'default') != 'default') {
                $currentCart = session('guestCart');
                $item = PhoneDetails::find($details_id)->first();
                $product = new ProductInCart($item->phone_details_id, $item->parentPhone->phone_name . ' ' . $item->parentSpecific->specific_name . ' ' . $item->parentColor->color_name, 1, $item->price, $item->discount, "img");
                $currentCart->AddToCart($product);
                session(['guestCart' => $currentCart]);
                return $details_id;
            }
            else {
                return null;
            }
        }
        return null;
    }
}
