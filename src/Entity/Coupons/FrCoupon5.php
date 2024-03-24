<?php

namespace App\Entity\Types\Coupons;

use App\Entity\Types\Coupons\CouponType;

class FrCoupon5 extends CouponType
{
    public function __constructor() {
        $this->setDiscount(5);
        $this->setCode('F5');
        $this->setCountry('France');
    }
}