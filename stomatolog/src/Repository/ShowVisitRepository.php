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

    public function findVisit(\DateTime $dateTimeNow): array
    {
        $StartDate = clone $dateTimeNow;
        $StartDate = $StartDate->add(new\DateInterval('P1D'));
        $EndDate = clone $StartDate;
        $EndDate = $EndDate->add(new\DateInterval('PT8H'));

        $qb = $this->createQueryBuilder('visit');
        $qb->where('visit.StartDate > :StartDate')
            ->andWhere('visit.StartDate <= :EndDate')
            ->setParameter('StartDate', $StartDate)
            ->setParameter('EndDate', $EndDate);

       // var_dump($qb->getQuery()->getSQL());
        $query = $qb->getQuery();

        return $query->getResult();
    }
}
