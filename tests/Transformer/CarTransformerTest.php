<?php

namespace App\Tests\Transformer;

use App\Entity\Car;
use App\Entity\Image;
use App\Entity\User;
use App\Transformer\CarTransformer;
use PHPUnit\Framework\TestCase;

class CarTransformerTest extends TestCase
{
    /**
     * @dataProvider carTransformerProvider
     * @param $param
     * @param $expected
     * @return void
     */
    public function testformArrayOfCarTransformer($param, $expected)
    {
        $image = $this->getMockBuilder(Image::class)->getMock();
        $user = $this->getMockBuilder(User::class)->getMock();
        $car = new Car();
        $car->setName($param['name']);
        $car->setDescription($param['description']);
        $car->setColor($param['color']);
        $car->setBrand($param['brand']);
        $car->setPrice($param['price']);
        $car->setSeats($param['seats']);
        $car->setYear($param['year']);
        $car->setThumbnailId($image);
        $car->setCreatedUserId($user);
        $carTransformer = new CarTransformer();
        $result = $carTransformer->fromArray($car);
        $this->assertEquals($expected, $result);
    }

    private function carTransformerProvider()
    {
        return [
            'case-1' => [
                'param' => [
                    'id' => null,
                    'name' => 'Mercedes C200 Exclusive',
                    'description' => 'Mercedes C200 Exclusive Description',
                    'color' => 'Red',
                    'brand' => 'Mercedes',
                    'price' => 546,
                    'seats' => 4,
                    'year' => 2020,
                ],
                'expected' => [
                    'id' => null,
                    'name' => 'Mercedes C200 Exclusive',
                    'description' => 'Mercedes C200 Exclusive Description',
                    'color' => 'Red',
                    'brand' => 'Mercedes',
                    'price' => 546,
                    'seats' => 4,
                    'year' => 2020,
                    'thumbnail' => [],
                    'createUser' => [],
                ],
            ]
        ];
    }
}
