<?php

namespace App\Tests\v1\Unit\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Products\Iphone;

class ProductTest extends TestCase
{
    public function testCanGetAndSetData(): void
    {
        $product = new Iphone();
        $product->setPrice(100);
        $product->setId(1);
        $product->setName('Iphone');

        self::assertSame('Iphone', $product->getName());
        self::assertSame(100, $product->getPrice());
        self::assertSame(1, $product->getId());
    }
}
