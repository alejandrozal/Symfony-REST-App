<?php

use App\Entity\Factories\Coupons\AbstractCouponFactoryMethod,
    App\Entity\Types\Coupons\DeCoupon10,
    App\Entity\Types\Coupons\DeCoupon15,
    App\Entity\Types\Coupons\FrCoupon5,
    App\Entity\Types\Coupons\GrCoupon10,
    App\Entity\Types\Coupons\GrCoupon34,
    App\Entity\Types\Coupons\GrCoupon45,
    App\Entity\Types\Coupons\ItCoupon3;

class CouponFactoryMethod extends AbstractCouponFactoryMethod
{
    function makeCoupon($param): DeCoupon15|ItCoupon3|GrCoupon45|FrCoupon5|GrCoupon10|GrCoupon34|DeCoupon10|null
    {
        $coupon = NULL;

        switch ($param) {
            case "D10":
                $coupon = new DeCoupon10();
                break;
            case "D15":
                $coupon = new DeCoupon15();
                break;
            case "F5":
                $coupon = new FrCoupon5();
                break;
            case "G10":
                $coupon = new GrCoupon10();
                break;
            case "G34":
                $coupon = new GrCoupon34();
                break;
            case "G45":
                $coupon = new GrCoupon45();
                break;
            case "I3":
                $coupon = new ItCoupon3();
                break;
        }

        return $coupon;
    }
}
