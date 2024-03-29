<?php

namespace App\Repository;

use App\Entity\Factories\Products\ProductFactoryMethod;
use App\Entity\Types\Products\IProductType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductRepository extends EntityRepository
{
    public function __construct(
        protected ProductFactoryMethod $productFactory,
        protected ValidatorInterface $validator
    ) {}
    /**
     * @param int $productId
     * @return IProductType|null
     */
    public function getProduct(int $productId): IProductType|null
    {
        $product = $this->productFactory->makeProduct($productId);

        if ($product) {
            $validations = $this->validator->validate($product);
            if ($validations->count()) {
//              TODO Unit tests
//              throw new ValidationFailedException($product, $validations);
            }
        } else {
            throw new NotFoundHttpException('Product not found.');
        }

        return $product;
    }
}