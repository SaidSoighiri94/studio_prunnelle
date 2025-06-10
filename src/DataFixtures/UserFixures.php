<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Faker\Factory;
use App\Entity\Adresse;
use App\Entity\TypePriseVue;
use App\entity\TypeVente;
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

        // Creation de 10 adresses
        $adresses = [];
        for ($i=0; $i <10 ; $i++) { 
            $adresse = (new Adresse())
            ->setRue($faker->streetName())
            ->setVille($faker->city())
            ->setCodePostale($faker->postcode())
            ->setPays($faker->country())
            ->setCreatedAt(new \DateTimeImmutable());

        $adresses[] = $adresse;
        $manager->persist($adresse);

        }

        // Creation des type de prise de vue
        $typePrises = [];
        for ($i=0; $i < 5; $i++) { 
            $typePrise = (new TypePriseVue())
            ->setNomTypePrise($faker->randomElement(['Individuel','Groupe seul','Individiuel + groupe', 'Mixte','groupe']))
            ->setCreatedAt(new \DateTimeImmutable());

        $typePrises[] = $typePrise;
        $manager->persist($typePrise); 
        }

        //Creation de type de vente
        $typeVentes = [];
        for ($i=0; $i < 3; $i++) { 
            $typeVente = (new TypeVente())
            ->setNomTypeVente($faker->randomElement(['Bon de commande','Internet','Hybride','Vente direct']))
            ->setCreatedAt(new \DateTimeImmutable());

        $typeVentes[] = $typeVente;
        $manager->persist($typeVente);
        }


        $manager->flush();
    }
}