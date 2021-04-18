<?php

namespace App\Repository;

use App\Entity\BureauxVote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BureauxVote|null find($id, $lockMode = null, $lockVersion = null)
 * @method BureauxVote|null findOneBy(array $criteria, array $orderBy = null)
 * @method BureauxVote[]    findAll()
 * @method BureauxVote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BureauxVoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BureauxVote::class);
    }

    // /**
    //  * @return BureauxVote[] Returns an array of BureauxVote objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BureauxVote
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
