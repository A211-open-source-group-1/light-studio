<?php
namespace App\Providers;

class ProductInCart {

    private $id;
    private $name;
    private $quantity;
    private $price;
    private $discount;
    private $img;

    public function __construct($id, $name, $quantity, $price, $discount, $img) {
        $this->id = $id;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->discount = $discount;
        $this->img = $img;
    }

    public function GetId() {
        return $this->id;
    }

    public function GetName() {
        return $this->name;
    }

    public function GetQuantity() {
        return $this->quantity;
    }

    public function GetPrice() {
        return $this->price;
    }

    public function GetImg() {
        return $this->img;
    }

    public function GetFinalPrice() {
        return ($this->price - $this->discount) * $this->quantity;
    }

    public function DecreaseQuantity($value) {
        if ($this->quantity - $value >= 0) {
            $this->quantity = $this->quantity - $value;
        }
    }

    public function IncreaseQuantity($value) {
        $this->quantity = $this->quantity + $value;
    }

    public function ChangeQuantity($value) {
        if ($value >= 0) {
            $this->quantity = $value;
        }
    }

}


?>