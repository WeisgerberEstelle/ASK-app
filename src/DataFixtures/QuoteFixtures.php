<?php

namespace App\DataFixtures;

use App\Entity\Quote;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class QuoteFixtures extends Fixture implements DependentFixtureInterface
{
    public const QUOTES = 10;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < self::QUOTES; $i++) {
            $quote = new Quote();
            $quote->setQuote($faker->realText($maxNbChars = 50, $indexSize = 2));
            $quote->setOwner($this->getReference('client_' . $i));
            $manager->persist($quote);
        }
        $manager->flush();
    }

    public function getDependencies()
    {

        return [

            ClientFixtures::class,

        ];
    }
}
