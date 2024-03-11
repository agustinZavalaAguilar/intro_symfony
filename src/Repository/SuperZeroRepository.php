<?php

namespace App\Repository;

use App\Entity\SuperZero;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SuperZero>
 *
 * @method SuperZero|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuperZero|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuperZero[]    findAll()
 * @method SuperZero[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuperZeroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SuperZero::class);
    }

    //    /**
    //     * @return SuperZero[] Returns an array of SuperZero objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?SuperZero
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
