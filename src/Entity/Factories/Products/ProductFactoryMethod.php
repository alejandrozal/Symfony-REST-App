<?php

namespace App\Entity\Factories\Products;

use App\Entity\Products\Iphone,
    App\Entity\Products\Headphones,
    App\Entity\Products\PhoneCase;

class ProductFactoryMethod extends AbstractProductFactoryMethod
{
    function makeProduct($param): Iphone|PhoneCase|Headphones|null
    {
        $product = NULL;

        switch ($param) {
            case 1:
                $product = new Iphone();
                $product->setPrice(100);
                $product->setId(1);
                $product->setName('Iphone');
                break;
            case 2:
                $product = new Headphones();
                $product->setPrice(20);
                $product->setId(2);
                $product->setName('Наушники');
                break;
            case 3:
                $product = new PhoneCase();
                $product->setPrice(10);
                $product->setId(3);
                $product->setName('Чехол');
                break;
        }

        return $product;
    }
}
