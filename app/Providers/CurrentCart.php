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
                $item->IncreaseQuantity($product->quantity);
                return;
            }
        }
        $this->products[] = $product;
    }

    public function GetProducts() {
        return $this->products;
    }

    public function Count() {
        return count($this->products);
    }

    public function ProductAt($index) {
        return $this->products[$index];
    }
}
?>