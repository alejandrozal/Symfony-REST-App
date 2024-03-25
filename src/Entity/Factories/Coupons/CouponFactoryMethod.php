<?php

namespace App\Entity\Factories\Coupons;

use App\Entity\Coupons\DeCoupon10;
use App\Entity\Coupons\DeCoupon15;
use App\Entity\Coupons\FrCoupon5;
use App\Entity\Coupons\GrCoupon10;
use App\Entity\Coupons\GrCoupon34;
use App\Entity\Coupons\GrCoupon45;
use App\Entity\Coupons\ItCoupon3;
use App\Entity\Coupons\GrCoupon6;

class CouponFactoryMethod extends AbstractCouponFactoryMethod
{
    function makeCoupon($param): DeCoupon15|ItCoupon3|GrCoupon45|FrCoupon5|GrCoupon10|GrCoupon34|DeCoupon10|GrCoupon6|null
    {
        $coupon = NULL;

        switch ($param) {
            case "D10":
                $coupon = new DeCoupon10();
                $coupon->setDiscount(10);
                //TODO Unit tests
                $coupon->setCode(''); // this line throws a Validation Exception just for a test
                $coupon->setCountry('Germany');
                break;
            case "D15":
                $coupon = new DeCoupon15();
                $coupon->setDiscount(15);
                $coupon->setCode('D15');
                $coupon->setCountry('Germany');
                break;
            case "F5":
                $coupon = new FrCoupon5();
                $coupon->setDiscount(5);
                $coupon->setCode('F5');
                $coupon->setCountry('France');
                break;
            case "G10":
                $coupon = new GrCoupon10();
                $coupon->setDiscount(10);
                $coupon->setCode('G10');
                $coupon->setCountry('Greece');
                break;
            case "G34":
                $coupon = new GrCoupon34();
                $coupon->setDiscount(34);
                $coupon->setCode('G34');
                $coupon->setCountry('Greece');
                break;
            case "G45":
                $coupon = new GrCoupon45();
                $coupon->setDiscount(45);
                $coupon->setCode('G45');
                $coupon->setCountry('Greece');
                break;
            case "I3":
                $coupon = new ItCoupon3();
                $coupon->setDiscount(3);
                $coupon->setCode('I3');
                $coupon->setCountry('Italy');
                break;
            case "G6":
                $coupon = new GrCoupon6();
                $coupon->setDiscount(6);
                $coupon->setCode('G6');
                $coupon->setCountry('Greece');
                break;
        }

        return $coupon;
    }
}
