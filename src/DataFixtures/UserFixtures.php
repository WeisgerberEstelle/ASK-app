<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;


    public function __construct(UserPasswordHasherInterface $passwordHasher) 

    {

        $this->passwordHasher = $passwordHasher;

    }

    public function load(ObjectManager $manager): void

    {
        $user = new User();

        $user->setEmail('andréamartel@monsite.com');
        $user->setLastname('Martel');
        $user->setFirstname('Andréa');
        $birthDate= new DateTime('10/02/1976');
        $user->setDateOfBirth($birthDate);
        $user->setRoles(['ROLE_User']);
        $this->addReference('agent_1' , $user);

        $hashedPassword = $this->passwordHasher->hashPassword(

            $user,

            'Userpassword'

        );

        $user->setPassword($hashedPassword);

        $manager->persist($user);

        $manager->flush();

    }
}
