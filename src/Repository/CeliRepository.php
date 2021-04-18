<?php

namespace App\Repository;

use App\Entity\Celi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Celi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Celi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Celi[]    findAll()
 * @method Celi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CeliRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Celi::class);
    }

    // /**
    //  * @return Celi[] Returns an array of Celi objects
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
    public function findOneBySomeField($value): ?Celi
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
