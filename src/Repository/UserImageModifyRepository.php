<?php

namespace App\Repository;

use App\Entity\UserImageModify;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserImageModify|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserImageModify|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserImageModify[]    findAll()
 * @method UserImageModify[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserImageModifyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserImageModify::class);
    }

    // /**
    //  * @return UserImageModify[] Returns an array of UserImageModify objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserImageModify
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
