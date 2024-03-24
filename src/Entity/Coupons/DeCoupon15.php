<?php

namespace App\Entity\Coupons;

use App\Entity\Types\Coupons\CouponType;

class DeCoupon15 extends CouponType
{
    public function __constructor() {
        $this->setDiscount(15);
        $this->setCode('D15');
        $this->setCountry('Germany');
    }
}