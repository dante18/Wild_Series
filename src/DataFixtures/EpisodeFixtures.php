<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Faker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i=0; $i < 20; $i++){
            $episode = new Episode();
            $episode->setNumber($faker->numberBetween(1,11));
            $episode->setTitle($faker->words(3, true));
            $episode->setSynopsis($faker->paragraph);
            $episode->setSeason($this->getReference('season'.rand(0,10)));
            $manager->persist($episode);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [SeasonFixtures::class];
    }
}