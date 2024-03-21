<?php

namespace App\Entity\Products;

use App\Entity\Types\Products\ProductType;

class PhoneCase extends ProductType
{
    private string $name;
    private int $id;
    private int $price;

    public function __constructor() {
        $this->name = 'Чехол';
        $this->id = 3;
        $this->price = 10;
    }
}