<?php

namespace App\Repository;

use App\Entity\Crv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Crv|null find($id, $lockMode = null, $lockVersion = null)
 * @method Crv|null findOneBy(array $criteria, array $orderBy = null)
 * @method Crv[]    findAll()
 * @method Crv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CrvRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Crv::class);
    }

    // /**
    //  * @return Crv[] Returns an array of Crv objects
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
    public function findOneBySomeField($value): ?Crv
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
