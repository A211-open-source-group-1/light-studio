<?php
namespace App\Providers;

include('ProductInCart.php');
class CurrentCart {
    private $products;

    public function __construct() {
        $this->products = collect();
    }

    public function AddToCart($product) {
        foreach ($this->products as $item) {
            if ($item->GetId() == $product->GetId()) {
                $item->IncreaseQuantity($product->GetQuantity());
                return;
            }
        }
        $this->products->push($product);
    }

    public function GetProducts() {
        return $this->products;
    }

    public function Remove($id) {
        $this->products = $this->products->filter(function ($prod) use ($id) {
            return $prod->GetId() != $id;
        });
    }

    public function Count() {
        return $this->products->count();
    }

    public function ProductAt($index) {
        return $this->products[$index];
    }
}
?>