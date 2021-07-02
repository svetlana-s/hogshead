<?php

namespace App\Repository;

use App\Entity\Fanfic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Fanfic|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fanfic|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fanfic[]    findAll()
 * @method Fanfic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FanficRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fanfic::class);
    }

    // /**
    //  * @return Fanfic[] Returns an array of Fanfic objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Fanfic
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
