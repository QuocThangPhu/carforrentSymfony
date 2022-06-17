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

        $image4 = new Image();
        $image4->setPath('http://diggory.me/upload/75400a40e54ffccb2c969e085e84d9c1amir-hosseini-NvyfHCDhvz0-unsplash.jpg');
        $image4->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($image4);

        $image5 = new Image();
        $image5->setPath('http://diggory.me/upload/6280b7b8c39f388d2fe14a1940119a69bmw-4-series-convertible-g23-2-59d6.jpg');
        $image5->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($image5);

        $image6 = new Image();
        $image6->setPath('http://diggory.me/upload/3ba687c2546378257249bc135a3cf792wes-tindel-F-3i7U7B7YU-unsplash.jpg');
        $image6->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($image6);

        $manager->flush();

        $this->addReference('image1', $image);
        $this->addReference('image2', $image1);
        $this->addReference('image3', $image2);
        $this->addReference('image4', $image4);
        $this->addReference('image5', $image5);
        $this->addReference('image6', $image6);
    }
}
