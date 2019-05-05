<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $adm = new \App\Entity\Administrador();
        $adm
            ->setUsername('admin')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword('admin');
        $manager->persist($adm);

        $manager->flush();
    }
}
