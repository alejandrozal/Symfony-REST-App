<?php

namespace App\Controller;

use App\Exception\FormException,
    Symfony\Bundle\FrameworkBundle\Controller\AbstractController,
    Symfony\Component\HttpFoundation\JsonResponse,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Component\Validator\Validation,
    App\Entity\Factories\Products\ProductFactoryMethod,
    App\Entity\Factories\Coupons\CouponFactoryMethod;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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

        $productId = $data["product"] ?? null;
        $taxNumber = $data["taxNumber"] ?? '';
        $couponCode = $data["couponCode"] ?? '';

        $product = $this->productFactory->makeProduct($productId);

        if ($product) {
            $violations = $validator->validate($product);
            //var_dump($violations);
        } else {
            throw new NotFoundHttpException('Product not found.');
        }

        $coupon = $this->couponFactory->makeCoupon($couponCode);

        if ($coupon) {
            $violations = $validator->validate($coupon);
//            var_dump($violations);
        } else {
            throw new NotFoundHttpException('Coupon not found.');
        }
        die();
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
