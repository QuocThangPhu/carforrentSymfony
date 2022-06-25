<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setName('admin');
        $user1->setEmail('admin@gmail.com');
        $user1->setPassword('$2a$12$7DTRErrSw50hO7A2iL0e8eYSfymgvhX2N6ir5kzSEiFvcbToYantC');
        $user1->setRoles('{"role": "ROLE_ADMIN"}');
        $manager->persist($user1);


        $user2 = new User();
        $user2->setName('user');
        $user2->setEmail('user@gmail.com');
        $user2->setPassword('$2a$12$7DTRErrSw50hO7A2iL0e8eYSfymgvhX2N6ir5kzSEiFvcbToYantC');
        $user2->setRoles('{"role": "ROLE_USER"}');
        $manager->persist($user2);

        $manager->flush();

        $this->addReference('user1', $user1);
        $this->addReference('user2', $user2);
    }
}
