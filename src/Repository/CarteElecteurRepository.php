<?php

namespace App\Repository;

use App\Entity\CarteElecteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CarteElecteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarteElecteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarteElecteur[]    findAll()
 * @method CarteElecteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarteElecteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarteElecteur::class);
    }

    // /**
    //  * @return CarteElecteur[] Returns an array of CarteElecteur objects
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
    public function findOneBySomeField($value): ?CarteElecteur
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
