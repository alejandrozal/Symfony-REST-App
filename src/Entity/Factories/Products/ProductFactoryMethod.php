<?php

use App\Entity\Factories\Products\AbstractProductFactoryMethod,
    \App\Entity\Products\Iphone,
    \App\Entity\Products\Headphones,
    \App\Entity\Products\PhoneCase;

class ProductFactoryMethod extends AbstractProductFactoryMethod
{
    function makeProduct($param)
    {
        $product = NULL;

        switch ($param) {
            case "Iphone":
                $product = new Iphone();
                break;
            case "Headphones":
                $product = new Headphones();
                break;
            case "PhoneCase":
                $product = new PhoneCase();
                break;
        }

        return $product;
    }
}
