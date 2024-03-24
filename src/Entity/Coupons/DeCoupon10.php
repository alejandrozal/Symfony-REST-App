<?php

namespace App\Entity\Types\Coupons;

use App\Entity\Types\Coupons\CouponType;

class DeCoupon10 extends CouponType
{
    public function __constructor() {
        $this->setDiscount(10);
        $this->setCode('D10');
        $this->setCountry('Germany');
    }
}