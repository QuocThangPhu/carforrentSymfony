<?php

namespace App\Tests\Service;

use App\Mapper\AddCarTransferToCar;
use App\Mapper\PatchCarTransferToCar;
use App\Mapper\PutCarTransferToCar;
use App\Repository\CarRepository;
use App\Service\CarService;
use App\Transfer\FilterTransfer;
use PHPUnit\Framework\TestCase;

class CarServiceTest extends TestCase
{

    /**
     * @dataProvider getCarsProvider
     * @param $param
     * @param $expected
     * @param $filter
     * @return void
     */
    public function testGetCars($param, $expected, $filter)
    {
        $carRepositoryMock = $this->getMockBuilder(CarRepository::class)
            ->disableOriginalConstructor()->getMock();
        $carRepositoryMock->expects($this->once())->method('all')->willReturn($param);
        $carTransferToCarMock = $this->getMockBuilder(AddCarTransferToCar::class)
            ->disableOriginalConstructor()->getMock();
        $putCarTransferToCarMock = $this->getMockBuilder(PutCarTransferToCar::class)
            ->disableOriginalConstructor()->getMock();
        $patchCarTransferToCarMock = $this->getMockBuilder(PatchCarTransferToCar::class)
            ->disableOriginalConstructor()->getMock();
        $carService = new CarService($carRepositoryMock, $carTransferToCarMock, $putCarTransferToCarMock, $patchCarTransferToCarMock);
        $filterTransfer = new FilterTransfer();
        $filterTransfer->transfer($filter);
        $result = $carService->getCars($filterTransfer);
        $this->assertEquals($expected, $result);
    }

    private function getCarsProvider()
    {
        return [
            'case-1' => [
                'param' => [
                    '1' => [
                        'id' => 1,
                        'name' => 'Mercedes C200 Exclusive',
                        'description' => 'Mercedes C200 Exclusive Description',
                        'color' => 'Red',
                        'brand' => 'Mercedes',
                        'price' => 546,
                        'seats' => 4,
                        'year' => 2020,
                        'thumbnail' => [
                            'id' => 1,
                            'path' => 'https=>//carforrent-diggory.s3.ap-southeast-1.amazonaws.com/upload/669d8bede8f43ae46276d9bb8c1f68b8g63.jpg'
                        ],
                        'createUser' => [
                            'id' => 9,
                            'name' => 'admin'
                        ]
                    ]
                ],
                'expected' => [
                    '1' => [
                        'id' => 1,
                        'name' => 'Mercedes C200 Exclusive',
                        'description' => 'Mercedes C200 Exclusive Description',
                        'color' => 'Red',
                        'brand' => 'Mercedes',
                        'price' => 546,
                        'seats' => 4,
                        'year' => 2020,
                        'thumbnail' => [
                            'id' => 1,
                            'path' => 'https=>//carforrent-diggory.s3.ap-southeast-1.amazonaws.com/upload/669d8bede8f43ae46276d9bb8c1f68b8g63.jpg'
                        ],
                        'createUser' => [
                            'id' => 9,
                            'name' => 'admin'
                        ]
                    ]
                ],
                'filter' => [
                    'color' => 'Red',
                    'brand' => 'Mercedes',
                    'seats' => 4,
                    'orderTy' => 'asc',
                    'orderBy' => 'price'
                ]
            ]
        ];
    }
}
