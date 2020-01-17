<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function getProductByRefOrByName($name,$ref)
    {
        // recuperer le query builder ( car c'est le query builder qui  permet de faire la requête SQL )
        $queryBuilder = $this->createQueryBuilder('product'); // 'product'= non que je lui donne

        // Construire la requête façon SQL, mais en PHP
        //traduire la requete en veritable requete SQL
        $query = $queryBuilder->select('product')
            ->join('product.galerie','h')
            ->addSelect('h')
            ->where('product.name LIKE :name')
            ->setParameter('name', '%' . $name . '%')
            ->andWhere('product.ref LIKE :ref')
            ->setParameter('ref', '%' . $ref . '%')
            ->getQuery();

        //Executer la requête en base de données pour recuperer les bonnes données
        $product = $query->getArrayResult();// demande de resultats en array mais d'autre possibilité son disponible

        return $product;
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
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
    public function findOneBySomeField($value): ?Product
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
