<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController,
    Symfony\Component\HttpFoundation\JsonResponse,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Component\Validator\Validation,
    App\Entity\Factories\Products\ProductFactoryMethod,
    App\Entity\Factories\Coupons\CouponFactoryMethod;

class PaymentController extends AbstractController
{
    private ProductFactoryMethod $productFactory;
    private CouponFactoryMethod $couponFactory;

    public function __construct()
    {
        $this->productFactory = new ProductFactoryMethod();
        $this->couponFactory = new CouponFactoryMethod();
    }

    public function calculatePrice(Request $request): JsonResponse
    {
        $productId = $request->get("id");
        $taxNumber = $request->get("taxNumber");
        $couponCode = $request->get("couponCode");

        $validator = Validation::createValidatorBuilder()->getValidator();

        $product = $this->productFactory->makeProduct($productId);

        if ($product) {
            $violations = $validator->validate($product);
            var_dump($violations);
        } else {
            die('error');
        }

        $coupon = $this->couponFactory->makeCoupon($couponCode);

        if ($coupon) {
            $violations = $validator->validate($coupon);
            var_dump($violations);
        } else {
            die('error');
        }

        return $this->json([
            'data' => $request->get("test"),
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PaymentController.php',
        ]);
    }

    public function purchase(Request $request): JsonResponse
    {
        return $this->json([
            'data' => $request->get("test"),
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PaymentController.php',
        ]);
    }
}
