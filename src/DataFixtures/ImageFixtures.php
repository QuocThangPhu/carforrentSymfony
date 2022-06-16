<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ImageFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $image = new Image();
        $image->setPath('https://carforrent-diggory.s3.ap-southeast-1.amazonaws.com/upload/669d8bede8f43ae46276d9bb8c1f68b8g63.jpg');
        $image->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($image);

        $image1 = new Image();
        $image1->setPath('http://diggory.me/upload/d045ab208c32b350d89a47f849f35268gls.jpg');
        $image1->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($image1);

        $image2 = new Image();
        $image2->setPath('http://diggory.me/upload/04aa6d370afe18bf2f7230447d4deba7BMWNiNI.jpg');
        $image2->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($image2);

        $manager->flush();

        $this->addReference('image3', $image);
        $this->addReference('image1', $image1);
        $this->addReference('image2', $image2);
    }
}
