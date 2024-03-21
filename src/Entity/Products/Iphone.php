<?php

namespace App\Entity\Products;

use App\Entity\Types\Products\ProductType;

class Iphone extends ProductType
{
    private string $name;
    private int $id;
    private int $price;

    public function __constructor() {
        $this->name = 'Iphone';
        $this->id = 1;
        $this->price = 100;
    }
}