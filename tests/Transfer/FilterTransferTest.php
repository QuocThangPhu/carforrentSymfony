<?php

namespace App\Tests\Transfer;

use App\Transfer\FilterTransfer;
use PHPUnit\Framework\TestCase;

class FilterTransferTest extends TestCase
{
    /**
     * @dataProvider filterTransferProvider
     * @param $param
     * @param $expected
     * @return void
     */
    public function testFilterTransfer($param, $expected)
    {
        $filterTransfer = new FilterTransfer();
        $filter = $filterTransfer->transfer($param);
        $this->assertEquals($expected['color'], $filter->getColor());
        $this->assertEquals($expected['brand'], $filter->getBrand());
        $this->assertEquals($expected['limit'], $filter->getLimit());
        $this->assertEquals($expected['seats'], $filter->getSeats());
        $this->assertEquals($expected['orderType'], $filter->getOrderType());
        $this->assertEquals($expected['orderBy'], $filter->getOrderBy());
    }

    private function filterTransferProvider()
    {
        return [
            'case-1' => [
                'param' => [
                    'color' => 'Red',
                    'brand' => 'Mercedes',
                    'seats' => 4,
                    'limit' => 10,
                    'orderType' => 'price',
                    'orderBy' => 'asc'
                ],
                'expected' => [
                    'color' => 'Red',
                    'brand' => 'Mercedes',
                    'seats' => 4,
                    'limit' => 10,
                    'orderType' => 'price',
                    'orderBy' => 'asc'
                ],
            ]
        ];
    }
}
