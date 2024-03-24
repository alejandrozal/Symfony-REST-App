<?php

namespace App\Entity\Products;

use App\Entity\Types\Products\ProductType;

class Iphone extends ProductType
{
    public function __constructor() {
        $this->setName('Iphone');
        $this->setId(1);
        $this->setPrice(100);
    }
}