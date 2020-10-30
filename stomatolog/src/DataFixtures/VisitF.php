<?php

namespace App\DataFixtures;

use App\Entity\Visit;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class VisitF extends Fixture implements DependentFixtureInterface
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // wizyta relatywna "dziś"
        $Visit = new Visit();
        $Visit->setPatient($this->getReference(PatientF::PATIENT1));
        $Visit->setDentist($this->getReference(DentistF::DENTIST1));

        $visitStart = new \DateTime('today');
        $visitEnd = (clone $visitStart)->modify('+30 minutes');

        $Visit->setStartDate($visitStart);
        $Visit->setEndDate($visitEnd);

        $manager->persist($Visit);



        $Visit = new Visit();
        $Visit->setPatient($this->getReference(PatientF::PATIENT2));
        $Visit->setDentist($this->getReference(DentistF::DENTIST2));

        $visitStart = new \DateTime('today');
        $visitEnd = (clone $visitStart)->modify('+30 minutes');

        $Visit->setStartDate($visitStart);
        $Visit->setEndDate($visitEnd);

        $manager->persist($Visit);



        // wizyta relatywna "jutro"
        $Visit = new Visit();
        $Visit->setPatient($this->getReference(PatientF::PATIENT3));
        $Visit->setDentist($this->getReference(DentistF::DENTIST1));

        $visitStart = new \DateTime('tomorrow');
        $visitEnd = (clone $visitStart)->modify('+30 minutes');

        $Visit->setStartDate($visitStart);
        $Visit->setEndDate($visitEnd);

        $manager->persist($Visit);

        $Visit = new Visit();
        $Visit->setPatient($this->getReference(PatientF::PATIENT4));
        $Visit->setDentist($this->getReference(DentistF::DENTIST2));

        $visitStart = new \DateTime('tomorrow');
        $visitEnd = (clone $visitStart)->modify('+30 minutes');

        $visitEnd = (clone $visitStart)->modify('+30 minutes');
        $Visit->setStartDate($visitStart);
        $Visit->setEndDate($visitEnd);

        $manager->persist($Visit);

        // wizyta relatywna "pojutrze"

        $Visit = new Visit();
        $Visit->setPatient($this->getReference(PatientF::PATIENT5));
        $Visit->setDentist($this->getReference(DentistF::DENTIST1));

        $visitStart = new \DateTime('today');
        $visitStart->add(new \DateInterval('P2D'));

        $visitEnd = (clone $visitStart)->modify('+30 minutes');
        $Visit->setStartDate($visitStart);
        $Visit->setEndDate($visitEnd);

        $manager->persist($Visit);

        $Visit = new Visit();
        $Visit->setPatient($this->getReference(PatientF::PATIENT6));
        $Visit->setDentist($this->getReference(DentistF::DENTIST2));

        $visitStart = new \DateTime('today');
        $visitStart->add(new \DateInterval('P2D'));

        $visitEnd = (clone $visitStart)->modify('+30 minutes');
        $Visit->setStartDate($visitStart);
        $Visit->setEndDate($visitEnd);

        $manager->persist($Visit);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [DentistF::class, PatientF::class];
    }
}
