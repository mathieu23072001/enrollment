<?php

namespace App\Repository;

use App\Entity\CarteInscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CarteInscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarteInscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarteInscription[]    findAll()
 * @method CarteInscription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarteInscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarteInscription::class);
    }

    // /**
    //  * @return CarteInscription[] Returns an array of CarteInscription objects
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
    public function findOneBySomeField($value): ?CarteInscription
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
