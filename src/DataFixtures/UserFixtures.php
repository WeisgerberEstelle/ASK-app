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
        $User = new User();

        $User->setEmail('andréamartel@monsite.com');
        $User->setLastname('Martel');
        $User->setFirstname('Andréa');
        $birthDate= new DateTime('10/02/1976');
        $User->setDateOfBirth($birthDate);
        $User->setRoles(['ROLE_User']);

        $hashedPassword = $this->passwordHasher->hashPassword(

            $User,

            'Userpassword'

        );

        $User->setPassword($hashedPassword);

        $manager->persist($User);

        $manager->flush();

    }
}
