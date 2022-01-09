<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ClientFixtures extends Fixture implements DependentFixtureInterface
{

    public const CLIENTS = 10;
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < self::CLIENTS; $i++) {
            $client = new Client();
            $client->setLastname($faker->lastName());
            $client->setFirstname($faker->firstName());
            $client->setEmail($faker->email());
            $client->setDateOfBirth($faker->dateTime());
            $client->setCity($faker->city);
            $client->setCountry($faker->country);
            $client->setPhoneNumber((int)$faker->serviceNumber());
            $client->setAgent($this->getReference('agent_1'));
            $manager->persist($client);
            $this->addReference('client_' . $i, $client);
        }
        $manager->flush();
    }

    public function getDependencies()

    {

        return [

          UserFixtures::class,

        ];
    }
}
