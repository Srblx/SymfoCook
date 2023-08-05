<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use App\Entity\Ingredient; 
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{

    /**
     * @var Generator
     */
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create("fr_FR");
    }

    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i <= 50 ; $i++) { 
       
            $ingredient = new Ingredient();
            $ingredient->setName($this->faker->word())
                ->setPrice(mt_rand(0, 100));
    
            $manager->persist($ingredient);
        }

        // ^ Geré par doctrine(ORM) pour persiter l'object ( prt a aller en bdd)
        // ^ Object manager contient plusieurs methodes
        $manager->flush();
    }
}
