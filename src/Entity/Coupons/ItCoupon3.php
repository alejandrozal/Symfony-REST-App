<?php

namespace App\Entity\Coupons;

use App\Entity\Types\Coupons\CouponType;

class ItCoupon3 extends CouponType
{
    public function __constructor() {
        $this->setDiscount(3);
        $this->setCode('I3');
        $this->setCountry('Italy');
    }
}