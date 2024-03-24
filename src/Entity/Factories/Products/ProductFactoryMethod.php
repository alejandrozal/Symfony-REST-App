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
                break;
            case 2:
                $product = new Headphones();
                break;
            case 3:
                $product = new PhoneCase();
                break;
        }

        return $product;
    }
}
