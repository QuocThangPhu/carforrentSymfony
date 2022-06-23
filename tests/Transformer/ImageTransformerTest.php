<?php

namespace App\Tests\Transformer;

use App\Entity\Image;
use App\Transformer\ImageTransformer;
use PHPUnit\Framework\TestCase;

class ImageTransformerTest extends TestCase
{
    /**
     * @dataProvider ImageTransformerProvider
     * @param $expected
     * @return void
     */
    public function testImgeTransformer($expected)
    {
        $image = new Image();
        $time = new \DateTimeImmutable();
        $image->setPath('test.jpg');
        $image->setCreatedAt($time);
        $expected['createdAt'] = $time;
        $imageTransformer = new ImageTransformer();
        $result = $imageTransformer->fromArray($image);
        $this->assertEquals($expected, $result);

    }

    private function ImageTransformerProvider()
    {
        return [
            'test-case-1' => [
                'expected' => [
                    'id' => null,
                    'path' => 'test.jpg'
                ]
            ]
        ];
    }
}
