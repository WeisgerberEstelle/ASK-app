<?php

namespace App\DataFixtures;

use App\Entity\Appointment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppointmentFixtures extends Fixture implements DependentFixtureInterface
{
    public const APPOINTMENTS = 10;
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < self::APPOINTMENTS; $i++) {
            $appointement= new Appointment();
            $appointement->setDate($faker->dateTimeThisMonth('+12 days'));
            $appointement->setTitle('Rendez-vous');
            $appointement->setOrganiser($this->getReference('agent_1'));
            $appointement->setClient($this->getReference('client_' . $i));
            $manager->persist($appointement);
        }

        $manager->flush();
    }

    public function getDependencies()
    {

        return [

            UserFixtures::class,
            ClientFixtures::class,
        ];
    }
}
