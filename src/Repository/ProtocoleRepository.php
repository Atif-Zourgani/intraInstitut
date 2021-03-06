<?php

namespace App\Repository;

use App\Entity\Protocole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Protocole|null find($id, $lockMode = null, $lockVersion = null)
 * @method Protocole|null findOneBy(array $criteria, array $orderBy = null)
 * @method Protocole[]    findAll()
 * @method Protocole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProtocoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Protocole::class);
    }

    // /**
    //  * @return Protocole[] Returns an array of Protocole objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Protocole
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
