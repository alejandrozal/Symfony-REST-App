<?php

namespace App\Entity\Factories\PaymentSystems;

use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;
use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;
use Exception;

class PaymentSystemFactoryMethod extends AbstractPaymentSystemFactoryMethod
{
    /**
     * @throws Exception
     */
    function makePaymentSystem($param, $price): Exception|bool|null
    {
        $result = NULL;

        switch ($param) {
            case "paypal":
                $paymentSystem = new PaypalPaymentProcessor();
                $paymentSystem->pay((int)$price);
                break;
            case "stripe":
                $paymentSystem = new StripePaymentProcessor();
                $result = $paymentSystem->processPayment((float)$price);
                break;
        }

        return $result;
    }
}
