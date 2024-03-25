<?php

namespace App\Entity\Factories\PaymentSystems;

abstract class AbstractPaymentSystemFactoryMethod
{
    abstract function makePaymentSystem($param, $price);
}
