<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Faker\Factory;
use App\Entity\Adresse;
use App\Entity\TypePriseVue;
use App\entity\TypeVente;
use App\Entity\Theme;
use App\Entity\Ecole;
use App\Entity\PriseDeVue;
use App\Entity\Pochette;
use App\Entity\Planche;
use Symfony\Bundle\FrameworkBundle\Command\SecretsSetCommand;
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
            ->setPays('France')
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
        for ($i=0; $i < 4; $i++) { 
            $typeVente = (new TypeVente())
            ->setNomTypeVente($faker->randomElement(['Bon de commande','Internet','Hybride','Vente direct']))
            ->setCreatedAt(new \DateTimeImmutable());

        $typeVentes[] = $typeVente;
        $manager->persist($typeVente);
        }

        //creation des themes
        $themes = [];
        for ($i=0; $i < 5; $i++) { 
            $theme = (new Theme())
            ->setNomTheme($faker->randomElement(['Sport','Culture','Musique','Art','Nature']))
            ->setCreatedAt(new \DateTimeImmutable())
            ->setCreateur($faker->randomElement([$admin, ...$users]));
        $themes[] = $theme;
        $manager->persist($theme);
        }

        // creations des ecoles
        $ecoles = [];
        for ($i=0; $i < 5; $i++) { 
            $ecole = (new Ecole())
                ->setCode($faker->unique()->numerify('#####'))
                ->setGenre($faker->randomElement(['Primaire', 'Collège', 'Lycée', 'Maternelle']))
                ->setNom($faker->company())
                ->setTel($faker->phoneNumber('0#########'))
                ->setEmail($faker->unique()->safeEmail())
                ->setActive($faker->boolean(90))
                ->setCreatedAt(new \DateTimeImmutable())
                ->setAdresse($adresses[$i]);

        $ecoles[] = $ecole; 
        $manager->persist($ecole);
        }

        $pochettes = [];
        // Creation de 10 pochettes
        for ($i=0; $i < 2; $i++) { 
            $pochette = (new Pochette())
                ->setNomPochette($faker->randomElement(['Individuelle','Fratrie']))
                ->setCreatedAt(new \DateTimeImmutable())
                ->setCreateur($faker->randomElement([$admin, ...$users]));

            $pochettes[] = $pochette;
            $manager->persist($pochette);
        }
        // Creation de 10 planches
        $planches = [];
        for ($i=0; $i < 10; $i++) { 
            $planche = (new Planche())
                ->setNomPlanche($faker->randomElement([ 
                    'Page souvenir',
                    'Multi avec marque page',
                    '9x13',
                    '10x15 et identités',
                    'Portrait couleur',
                    'Portrait noir et blanc',
                    'Double 13x18',
                    'Quatre 9x13']))
                ->setCreateur($faker->randomElement([$admin, ...$users]))
                ->setCreateAt(new \DateTimeImmutable())
                ->setUpdatedAt(new \DateTimeImmutable())
                ->addPochette($faker->randomElement($pochettes));

            $planches[] = $planche;
            $manager->persist($planche);
        }

        $priseVues = [];
        // Creation des prise de vue
        for ($i=0; $i < 10; $i++) { 
            $priseDeVue = (new PriseDeVue())
                ->setDatePriseVue(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 year', 'now')))
                ->setCratedAt(new \DateTimeImmutable())
                ->setPrixParent($faker->randomFloat(2, 5, 100))
                ->setPrixEcole($faker->randomFloat(2, 5, 100))
                ->setEcole($faker->randomElement($ecoles))
                ->setPhotographe($faker->randomElement([$admin, ...$users]))
                ->setTypeDePrise($faker->randomElement($typePrises))
                ->setTypeVente($faker->randomElement($typeVentes))
                ->setTheme($faker->randomElement($themes))
                ->setNbEleve($faker->numberBetween(10, 30))
                ->setNbClasse($faker->numberBetween(1, 5))
                ->setCommentaires($faker->optional()->text(200))
                ->addPochette($faker->randomElement($pochettes));       
        $priseVues[] = $priseDeVue;    
        $manager->persist($priseDeVue);
        }
        $manager->flush();
    }
}