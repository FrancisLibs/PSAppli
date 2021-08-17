<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use App\Entity\Organisation;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;
    private $manager;

    public function __construct(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager)
    {
        $this->passwordHasher = $passwordHasher;
        $this->manager = $entityManager;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        //ORGANISATIONS
        $organisationArray = ['Pierre Schmidt W1', 'Pierre Schmidt W2', 'Pierre Schmidt R2', 'Stoeffler'];
        foreach ($organisationArray as $org) {
            $organisation = (new Organisation())->setDesignation($org);
            $manager->persist($organisation);
            //USERS
            for ($i = 0; $i < 5; $i++) {
                $user  = (new User());
                $user->setUsername($faker->name)
                    ->setPhoneNumber($faker->phoneNumber)
                    ->setFirstName($faker->firstName)
                    ->setLastName($faker->lastName)
                    ->setPassword($this->passwordHasher->hashPassword($user, 'password'))
                    ->setRoles(['ROLE_USER'])
                    ->setOrganisation($organisation)
                    ->setEmail($faker->email);
                $this->manager->persist($user);
            }
        }
        $this->manager->flush();
    }
}
