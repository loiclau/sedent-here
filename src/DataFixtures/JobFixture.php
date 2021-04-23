<?php

namespace App\DataFixtures;

use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class JobFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i =0; $i<100; $i++){
            $job = new Job();
            $job
                -> setTitle($faker->words(3,true))
                -> setDescription($faker->sentences(3,true))
                -> setExperience($faker->numberBetween(0,9))
                -> setSalary($faker->numberBetween(30000,100000))
                -> setCity($faker->city)
                -> setAddress($faker->address)
                -> setPostalCode($faker->postcode)
                -> setIsAvailable(true);
            $manager->persist($job);
        }
        $manager->flush();
    }
}
