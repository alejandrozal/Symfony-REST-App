<?php

namespace App\Entity\Products;

use App\Entity\Types\Products\ProductType;

class Headphones extends ProductType
{
    public function __constructor() {
        $this->setName('Наушники');
        $this->setId(2);
        $this->setPrice(20);
    }
}