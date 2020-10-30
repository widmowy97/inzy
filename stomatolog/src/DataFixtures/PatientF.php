<?php

namespace App\DataFixtures;

use App\Entity\Patient;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PatientF extends Fixture
{
    private $passwordEncoder;

    public const PATIENT1 = 'Pacjent Fryzjer Kowalski';
    public const PATIENT2 = 'Pacjent Polonista Kowalski';

    public const PATIENT3 = 'Pacjentka Naukowczyni Nowak';
    public const PATIENT4 = 'Pacjentka Pilotka Nowak';

    public const PATIENT5 = 'Pacjent Emeryt Michalik';
    public const PATIENT6 = 'Pacjent Stolarz Michalik';

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $Fryzjer = new Patient();
        $Fryzjer->setRoles(['ROLE_USER', 'ROLE_PATIENT']);
        $Fryzjer->setEmail('Fryzjer@Kowalski.ok');
        $Fryzjer->setPassword($this->passwordEncoder->encodePassword($Fryzjer, 'pass'));
        $Fryzjer->setFirstName('Fryzjer');
        $Fryzjer->setLastName('Kowalski');

        $this->addReference(self::PATIENT1, $Fryzjer);

        $manager->persist($Fryzjer);

        $Polonista = new Patient();
        $Polonista->setRoles(['ROLE_USER', 'ROLE_PATIENT']);
        $Polonista->setEmail('KatarPolonistazyna@Kowalski.ok');
        $Polonista->setPassword($this->passwordEncoder->encodePassword($Polonista, 'pass'));
        $Polonista->setFirstName('Polonista');
        $Polonista->setLastName('Kowalski');

        $this->addReference(self::PATIENT2, $Polonista);

        $manager->persist($Polonista);

        $Naukowczyni = new Patient();
        $Naukowczyni->setRoles(['ROLE_USER', 'ROLE_PATIENT']);
        $Naukowczyni->setEmail('Naukowczyni@Nowak.ok');
        $Naukowczyni->setPassword($this->passwordEncoder->encodePassword($Naukowczyni, 'pass'));
        $Naukowczyni->setFirstName('Naukowczyni');
        $Naukowczyni->setLastName('Nowak');

        $this->addReference(self::PATIENT3, $Naukowczyni);

        $manager->persist($Naukowczyni);

        $Pilotka = new Patient();
        $Pilotka->setRoles(['ROLE_USER', 'ROLE_PATIENT']);
        $Pilotka->setEmail('Pilotka@Nowak.ok');
        $Pilotka->setPassword($this->passwordEncoder->encodePassword($Pilotka, 'pass'));
        $Pilotka->setFirstName('Pilotka');
        $Pilotka->setLastName('Nowak');

        $this->addReference(self::PATIENT4, $Pilotka);

        $manager->persist($Pilotka);

        $Emeryt = new Patient();
        $Emeryt->setRoles(['ROLE_USER', 'ROLE_PATIENT']);
        $Emeryt->setEmail('Emeryt@Michalik.ok');
        $Emeryt->setPassword($this->passwordEncoder->encodePassword($Emeryt, 'pass'));
        $Emeryt->setFirstName('Emeryt');
        $Emeryt->setLastName('Michalik');

        $this->addReference(self::PATIENT5, $Emeryt);

        $manager->persist($Emeryt);

        $Stolarz = new Patient();
        $Stolarz->setRoles(['ROLE_USER', 'ROLE_PATIENT']);
        $Stolarz->setEmail('Stolarz@Michalik.ok');
        $Stolarz->setPassword($this->passwordEncoder->encodePassword($Stolarz, 'pass'));
        $Stolarz->setFirstName('Stolarz');
        $Stolarz->setLastName('Michalik');

        $this->addReference(self::PATIENT6, $Stolarz);

        $manager->persist($Stolarz);

        $manager->flush();

    }

}
