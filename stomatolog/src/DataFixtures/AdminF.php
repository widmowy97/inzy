<?php

namespace App\DataFixtures;


use App\Entity\Dentist;
use App\Entity\Patient;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AdminF extends Fixture
{
    private $passwordEncoder;

    public function  __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setEmail('boss@admin.com');
        $admin->setPassword($this->passwordEncoder->encodePassword($admin, 'Mojehaslo'));
        $manager->persist($admin);

        $manager->flush();
    }

}