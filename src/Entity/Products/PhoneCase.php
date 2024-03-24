<?php

namespace App\Entity\Products;

use App\Entity\Types\Products\ProductType;

class PhoneCase extends ProductType
{
    public function __constructor() {
        $this->setName('Чехол');
        $this->setId(3);
        $this->setPrice(10);
    }
}