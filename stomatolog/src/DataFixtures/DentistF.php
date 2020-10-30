<?php

namespace App\DataFixtures;

use App\Entity\Dentist;
use App\Entity\Patient;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DentistF extends Fixture implements DependentFixtureInterface
{
    private $passwordEncoder;

    public const DENTIST1 = 'Dentist Justyna Wrona';
    public const DENTIST2 = 'Dentist Katarzyna Imienna';

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $jw = new Dentist();
        $jw->setRoles(['ROLE_USER', 'ROLE_DENTIST','ROLE_ADMIN']);
        $jw->setEmail('jw@doctor.ok');
        $jw->setPassword($this->passwordEncoder->encodePassword($jw, 'pass'));
        $jw->setFirstName('Justyna');
        $jw->setLastName('Wrona');
        $jw->setSpecialization($this->getReference(SpecializationF::REF_KANALOWE));

        $manager->persist($jw);
        $manager->flush();

        $this->addReference(self::DENTIST1, $jw);

        $ki = new Dentist();
        $ki->setRoles(['ROLE_USER', 'ROLE_DENTIST','ROLE_ADMIN']);
        $ki->setEmail('ki@doctor.ok');
        $ki->setPassword($this->passwordEncoder->encodePassword($ki, 'pass'));
        $ki->setFirstName('Katarzyna');
        $ki->setLastName('Imienna');
        $ki->setSpecialization($this->getReference(SpecializationF::REF_KANALOWE));

        $manager->persist($ki);
        $manager->flush();

        $this->addReference(self::DENTIST2, $ki);
    }

    public function getDependencies()
    {
        return [SpecializationF::class];
    }

}
