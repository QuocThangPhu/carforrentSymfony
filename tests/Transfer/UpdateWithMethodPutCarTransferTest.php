<?php

namespace App\Tests\Transfer;

use App\Transfer\UpdateWithMethodPatchCarTransfer;
use App\Transfer\UpdateWithMethodPutCarTransfer;
use PHPUnit\Framework\TestCase;

class UpdateWithMethodPutCarTransferTest extends TestCase
{
    /**
     * @dataProvider updateCarWithMethodPutTransferProvider
     * @param $param
     * @param $expected
     * @return void
     */
    public function testCarTransfer($param, $expected)
    {
        $carTransfer = new UpdateWithMethodPutCarTransfer();
        $car = $carTransfer->transfer($param);
        $time = new \DateTimeImmutable();
        $car->setCreatedAt($time);
        $this->assertEquals($expected['name'], $car->getName());
        $this->assertEquals($expected['description'], $car->getDescription());
        $this->assertEquals($expected['color'], $car->getColor());
        $this->assertEquals($expected['brand'], $car->getBrand());
        $this->assertEquals($expected['price'], $car->getPrice());
        $this->assertEquals($expected['seats'], $car->getSeats());
        $this->assertEquals($expected['year'], $car->getYear());
        $this->assertEquals($expected['thumbnail'], $car->getThumbnail());
        $this->assertEquals($time, $car->getCreatedAt());
    }

    private function updateCarWithMethodPutTransferProvider()
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
                    'thumbnail' => 1,
                ],
                'expected' => [
                    'name' => 'Mercedes C200 Exclusive',
                    'description' => 'Mercedes C200 Exclusive Description',
                    'color' => 'Red',
                    'brand' => 'Mercedes',
                    'price' => 546,
                    'seats' => 4,
                    'year' => 2020,
                    'thumbnail' => 1,
                ],
            ]
        ];
    }
}
