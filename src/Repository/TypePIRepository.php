<?php

namespace App\Repository;

use App\Entity\TypePI;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypePI>
 *
 * @method TypePI|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypePI|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypePI[]    findAll()
 * @method TypePI[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypePIRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypePI::class);
    }

//    /**
//     * @return TypePI[] Returns an array of TypePI objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypePI
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
