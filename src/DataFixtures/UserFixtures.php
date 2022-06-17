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
        $user1->setPassword('nrYnFldRtWnB9IN5OWsOu6XGEfMsRdhdrQY7OiffpTAj7j0dG6e');
        $user1->setRoles((array)'{"role": "ROLE_ADMIN"}');
        $manager->persist($user1);


        $user2 = new User();
        $user2->setName('user');
        $user2->setEmail('user@gmail.com');
        $user2->setPassword('nrYnFldRtWnB9IN5OWsOu6XGEfMsRdhdrQY7OiffpTAj7j0dG6e');
        $user2->setRoles((array)'{"role": "ROLE_USER"}');
        $manager->persist($user2);

        $manager->flush();

        $this->addReference('user1', $user1);
        $this->addReference('user2', $user2);
    }
}
