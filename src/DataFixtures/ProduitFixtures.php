<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;


class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 100; $i ++ ){
            $property = new Property();
            $property->setTitle($faker->words(3,true))
                ->setPrice($faker->numberBetween(30000,700000))
                ->setRooms($faker->numberBetween(2,7))
                ->setBedrooms($faker->numberBetween(1,3))
                ->setDescription('petite apparte')
                ->setSurface($faker->numberBetween(10,350))
                ->setFloor($faker->numberBetween(0,10))
                ->setHeat($faker->numberBetween(0,count(Property::HEAT)-1))
                ->setCity($faker->city)
                ->setAdress($faker->address)
                ->setPostalCode($faker->postcode)
                ->setSold(false)
                ->setUpdatedAt($faker->dateTimeBetween('-1 week'));

            $manager->persist($property);
        }

                 

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
