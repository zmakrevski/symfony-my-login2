<?php

namespace App\DataFixtures;

use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne([
            'password' => 'tada',
            'email' => 'zoran@makrevski.com',
            'roles' => ['ROLE_USER', 'ROLE_ADMIN'],
            'firstName' => 'Zoran',
            'lastName' => 'Makrevski',
            'mobilePhone' => '6984919408'
        ]);
        UserFactory::createMany(10);

        $manager->flush();
    }
}
