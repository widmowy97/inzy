<?php

namespace App\Repository;

use App\Entity\Patient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Visit;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

class ShowVisitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Visit::class);
    }

    public function findByPatient(Patient $patient)
    {
        return $this->findBy([
            'patient' => $patient
        ]);
    }

    public function findTomorrowsVisits(): array
    {
        $StartDate = new \DateTime('now');
        $StartDate->add(new \DateInterval('P1D'));
        $StartDate->setTime(00, 00, 00);

        $EndDate = clone $StartDate;
        $EndDate->setTime(23, 59, 59);

        $qb = $this->createQueryBuilder('visit');
        $qb->where('visit.StartDate >= :StartDate')
            ->andWhere('visit.EndDate <= :EndDate')
            ->setParameter('StartDate', $StartDate)
            ->setParameter('EndDate', $EndDate);

       // var_dump($qb->getQuery()->getSQL(),$qb->getQuery()->getParameters());exit;
        $query = $qb->getQuery();

        return $query->getResult();
    }
}
