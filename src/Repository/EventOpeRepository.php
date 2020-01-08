<?php

namespace App\Repository;

use App\Entity\EventOpe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EventOpe|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventOpe|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventOpe[]    findAll()
 * @method EventOpe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventOpeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EventOpe::class);
    }

    // /**
    //  * @return EventOpe[] Returns an array of EventOpe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EventOpe
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
