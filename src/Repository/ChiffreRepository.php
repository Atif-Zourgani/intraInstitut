<?php

namespace App\Repository;

use App\Entity\Chiffre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Chiffre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chiffre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chiffre[]    findAll()
 * @method Chiffre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChiffreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chiffre::class);
    }

    // /**
    //  * @return Chiffre[] Returns an array of Chiffre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Chiffre
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
