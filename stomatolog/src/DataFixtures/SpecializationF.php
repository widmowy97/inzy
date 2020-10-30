<?php


namespace App\DataFixtures;


use App\Entity\Dentist;
use App\Entity\Patient;
use App\Entity\Specialization;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SpecializationF extends Fixture
{
    public const REF_KANALOWE = 'kanalowe';
    public const REF_CHIRURG = 'chirurg';

    public function load(ObjectManager $manager)
    {
        $specialization1 = new Specialization();
        $specialization1->setName('kanalowe');
        $manager->persist($specialization1);
        $this->addReference(self::REF_KANALOWE, $specialization1);

        $specialization2 = new Specialization();
        $specialization2->setName('chirurg');
        $manager->persist($specialization2);
        $this->addReference(self::REF_CHIRURG, $specialization2);

        $manager->flush();
    }
}