<?php

namespace App\Repository;

use App\Entity\Stagiaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Stagiaire>
 *
 * @method Stagiaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stagiaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stagiaire[]    findAll()
 * @method Stagiaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StagiaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stagiaire::class);
    }

//    /**
//     * @return Stagiaire[] Returns an array of Stagiaire objects
//     */

    public function findAllStagiairesNonInscrit(): array
    {
        $stagiairesNonInscrit = $qb->select('st')
                                ->from('app\Entity\Stagiaire', 'st')
                                ->where($qb->expr()->notIn('st.id', ))


        // $entityManager = $this->getEntityManager();

        // $query = $entityManager->createQuery(
        //     'SELECT st
        //     FROM app\Entity\Stagiaire st
        //     WHERE st.id
        //     NOT IN (
        //         SELECT ss.stagiaire_id
        //         FROM stagiaire_session ss
        //         WHERE ss.session_id = $id
        //     '
        // );

        // return $query->getResult();

    }


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

//    public function findOneBySomeField($value): ?Stagiaire
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
