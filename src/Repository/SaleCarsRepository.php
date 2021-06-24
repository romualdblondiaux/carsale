<?php

namespace App\Repository;

use App\Entity\SaleCars;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SaleCars|null find($id, $lockMode = null, $lockVersion = null)
 * @method SaleCars|null findOneBy(array $criteria, array $orderBy = null)
 * @method SaleCars[]    findAll()
 * @method SaleCars[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SaleCarsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SaleCars::class);
    }

    // /**
    //  * @return SaleCars[] Returns an array of SaleCars objects
    //  */
    
    public function findBySeller($part)
    {
        return $this->createQueryBuilder('s')
            ->join('s.id_user','u')
            ->andWhere('u.seller = :val')
            ->setParameter('val', $part)
            ->orderBy('s.marque', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByNewSeller($part)
    {
        return $this->createQueryBuilder('s')
            ->join('s.id_user','u')
            ->andWhere('u.seller = :val')
            ->setParameter('val', $part)
            ->orderBy('s.id', 'DESC')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?SaleCars
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
