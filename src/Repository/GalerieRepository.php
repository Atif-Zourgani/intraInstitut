<?php

namespace App\Repository;

use App\Entity\Galerie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Galerie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Galerie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Galerie[]    findAll()
 * @method Galerie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GalerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Galerie::class);
    }

    public function getGalerieByDescriptionOrByName($name,$description)
    {
        // recuperer le query builder ( car c'est le query builder qui  permet de faire la requête SQL )
        $queryBuilder = $this->createQueryBuilder('galerie'); // 'galerie'= non que je lui donne

        // Construire la requête façon SQL, mais en PHP
        //traduire la requete en veritable requete SQL
        $query = $queryBuilder->select('galerie')
            ->where('galerie.name LIKE :name')
            ->setParameter('name', '%' . $name . '%')
            ->andWhere('galerie.description LIKE :description')
            ->setParameter('description', '%' . $description . '%')
            ->getQuery();

        //Executer la requête en base de données pour recuperer les bons livres
        $galerie = $query->getArrayResult();// demande de resultats en array mais d'autre possibilité son disponible

        return $galerie;
    }

    // /**
    //  * @return Galerie[] Returns an array of Galerie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Galerie
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
