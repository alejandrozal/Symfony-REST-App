<?php

namespace App\Helpers;

use App\Entity\Types\Coupons\ICouponType;
use App\Entity\Types\Products\IProductType;

class Helper
{
    public static function getCountryByTaxNumber($code): ?string
    {
        $country = NULL;

        switch ($code) {
            case str_starts_with($code, 'DE'):
                $country = "GERMANY";
                break;
            case str_starts_with($code, 'FR'):
                $country = "FRANCE";
                break;
            case str_starts_with($code, 'GR'):
                $country = "GREECE";
                break;
            case str_starts_with($code, 'IT'):
                $country = "ITALY";
                break;
        }

        return $country;
    }

    public static function calculatePrice($taxNumber, IProductType $product = NULL, ICouponType $coupon = NULL): float
    {
        $countryTax = 0;
        $discount = 0;
        $couponCountry = '';
        $productPrice = $product->getPrice();
        $country = self::getCountryByTaxNumber($taxNumber);

        if ($country) {
            $countryTax = constant("App\Entity\Country::$country");
        }

        if ($coupon) {
            $discount = $coupon->getDiscount();
            $couponCountry = $coupon->getCountry();
        }

        $totalPrice = $productPrice + ($productPrice / 100 * $countryTax);

        if ($discount > 0) {
            if ($country == $couponCountry) {
                $totalPrice -= $totalPrice / 100 * $discount;
            }
        }

        return $totalPrice;
    }
}
