<?php

use \App\Entity\Factories\Coupons\AbstractCouponFactoryMethod;

class CouponFactoryMethod extends AbstractCouponFactoryMethod
{
    function makeCoupon($param)
    {
        $coupon = NULL;
        switch ($param) {
            case "D10":
                $coupon = new \App\Entity\Types\Coupons\DeCoupon10();
                break;
            case "D15":
                $coupon = new \App\Entity\Types\Coupons\DeCoupon15();
                break;
            case "F5":
                $coupon = new \App\Entity\Types\Coupons\FrCoupon5();
                break;
            case "G10":
                $coupon = new \App\Entity\Types\Coupons\GrCoupon10();
                break;
            case "G34":
                $coupon = new \App\Entity\Types\Coupons\GrCoupon34();
                break;
            case "G45":
                $coupon = new \App\Entity\Types\Coupons\GrCoupon45();
                break;
            case "I3":
                $coupon = new \App\Entity\Types\Coupons\ItCoupon3();
                break;
        }

        return $coupon;
    }
}
