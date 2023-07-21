<?php

namespace App\Repository;

use App\Entity\Inscrires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Inscrires>
 *
 * @method Inscrires|null find($id, $lockMode = null, $lockVersion = null)
 * @method Inscrires|null findOneBy(array $criteria, array $orderBy = null)
 * @method Inscrires[]    findAll()
 * @method Inscrires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InscriresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Inscrires::class);
    }

//    /**
//     * @return Inscrires[] Returns an array of Inscrires objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Inscrires
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
