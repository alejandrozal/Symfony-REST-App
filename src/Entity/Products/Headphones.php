<?php

namespace App\Entity\Products;

use App\Entity\Types\Products\ProductType;

class Headphones extends ProductType
{
    private string $name;
    private int $id;
    private int $price;

    public function __constructor() {
        $this->name = 'Наушники';
        $this->id = 2;
        $this->price = 20;
    }
}