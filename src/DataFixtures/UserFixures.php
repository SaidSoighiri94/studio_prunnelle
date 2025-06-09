<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Faker\Factory;
use App\Entity\Addresse;

class UserFixures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Creation d'une instance faker avec le local francais

        $faker = Factory::create('fr_FR');

        //Creation d'un utilisateur admin
        //$admin = (new User())
         //   ->set
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
