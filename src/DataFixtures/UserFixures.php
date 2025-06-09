<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Faker\Factory;
use App\Entity\Addresse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Creation d'une instance faker avec le local francais
        $faker = Factory::create('fr_FR');

        // Creation d'un utilisateur admin
        $admin = (new User())
           ->setEmail('admin@exemple.com')
           ->setNom('Mohamed')
           ->setPrenom('SAID')
           ->setCreatedAt(new \DateTimeImmutable())
           ->setRoles(['ROLE_ADMIN']);

        // Hashage de mot de passe 
        $hashedPassword = $this->passwordHasher->hashPassword($admin, 'adminPass');
        $admin->setPassword($hashedPassword);

        $manager->persist($admin);

        // Creation de 4 utilisateurs
        $users = [];
        for ($i = 0; $i < 3; $i++) { 
            $user = (new User())
                ->setEmail($faker->unique()->safeEmail())
                ->setNom($faker->lastName())
                ->setPrenom($faker->firstName())
                ->setCreatedAt(new \DateTimeImmutable())
                ->setRoles(['ROLE_USER']);
            
            $hashedPassword = $this->passwordHasher->hashPassword($user, 'password123');
            $user->setPassword($hashedPassword);
            
            $users[] = $user;
            $manager->persist($user);
        }

        $manager->flush();
    }
}