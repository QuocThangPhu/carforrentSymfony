<?php

namespace App\Tests\Transfer;

use App\Entity\User;
use App\Transfer\CarTransfer;
use PHPUnit\Framework\TestCase;

class CarTransferTest extends TestCase
{
    /**
     * @dataProvider carTransferProvider
     * @param $param
     * @param $expected
     * @return void
     */
    public function testCarTransfer($param, $expected)
    {
        $carTransfer = new CarTransfer();
        $car = $carTransfer->transfer($param);
        $this->assertEquals($expected['name'], $car->getName());
        $this->assertEquals($expected['description'], $car->getDescription());
        $this->assertEquals($expected['color'], $car->getColor());
        $this->assertEquals($expected['brand'], $car->getBrand());
        $this->assertEquals($expected['price'], $car->getPrice());
        $this->assertEquals($expected['seats'], $car->getSeats());
        $this->assertEquals($expected['year'], $car->getYear());
        $this->assertEquals($expected['thumbnail'], $car->getThumbnail());

    }

    private function carTransferProvider()
    {
        return [
            'case-1' => [
                'param' => [
                    'name' => 'Mercedes C200 Exclusive',
                    'description' => 'Mercedes C200 Exclusive Description',
                    'color' => 'Red',
                    'brand' => 'Mercedes',
                    'price' => 546,
                    'seats' => 4,
                    'year' => 2020,
                    'thumbnail' => 1
                ],
                'expected' => [
                    'name' => 'Mercedes C200 Exclusive',
                    'description' => 'Mercedes C200 Exclusive Description',
                    'color' => 'Red',
                    'brand' => 'Mercedes',
                    'price' => 546,
                    'seats' => 4,
                    'year' => 2020,
                    'thumbnail' => 1
                ],
            ]
        ];
    }
}
