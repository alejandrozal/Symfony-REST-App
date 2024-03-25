<?php

namespace App\Controller;

use App\Entity\Types\Coupons\ICouponType;
use App\Entity\Types\Products\IProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Factories\Products\ProductFactoryMethod;
use App\Entity\Factories\Coupons\CouponFactoryMethod;
use App\Helpers\Helper;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PaymentController extends AbstractController
{
    private ProductFactoryMethod $productFactory;
    private CouponFactoryMethod $couponFactory;

    public function __construct()
    {
        $this->productFactory = new ProductFactoryMethod();
        $this->couponFactory = new CouponFactoryMethod();
    }

    public function calculatePrice(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $productId = $data["product"] ?? 0;
        $taxNumber = $data["taxNumber"] ?? '';
        $couponCode = $data["couponCode"] ?? '';

        $product = $this->getProduct($productId, $validator);
        $coupon = $this->getCoupon($couponCode, $validator);

        $totalPrice = Helper::calculatePrice($taxNumber, $product, $coupon);

        return $this->json([
            'data' => ['price' => $totalPrice],
            'message' => 'Total price is ' . $totalPrice
        ]);
    }

    public function purchase(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $productId = $data["product"] ?? 0;
        $taxNumber = $data["taxNumber"] ?? '';
        $couponCode = $data["couponCode"] ?? '';
        $paymentProcessor =  $data["paymentProcessor"] ?? '';

        $product = $this->getProduct($productId, $validator);
        $coupon = $this->getCoupon($couponCode, $validator);

        $totalPrice = Helper::calculatePrice($taxNumber, $product, $coupon);

        return $this->json([
            'data' => $request->get("test"),
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PaymentController.php',
        ]);
    }

    /**
     * @param int $productId
     * @param ValidatorInterface $validator
     * @return IProductType
     */
    public function getProduct(int $productId, ValidatorInterface $validator): IProductType
    {
        $product = $this->productFactory->makeProduct($productId);

        if ($product) {
            $validations = $validator->validate($product);
            if ($validations->count()) {
//              TODO Unit tests
//              throw new ValidatorException($validations);
            }
        } else {
            throw new NotFoundHttpException('Product not found.');
        }

        return $product;
    }

    /**
     * @param string $couponCode
     * @param ValidatorInterface $validator
     * @return ICouponType
     */
    public function getCoupon(string $couponCode, ValidatorInterface $validator): ICouponType
    {
        //TODO refactor
        $coupon = $this->couponFactory->makeCoupon($couponCode);

        if ($coupon) {
            $validations = $validator->validate($coupon);
//          this is just an example of validation failure for "couponCode": "D10"
            if ($validations->count()) {
//              TODO Unit tests
                throw new ValidatorException($validations);
            }
        }

        return $coupon;
    }
}
