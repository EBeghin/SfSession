<?php

namespace App\Repository;

use App\Entity\Session;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Session>
 *
 * @method Session|null find($id, $lockMode = null, $lockVersion = null)
 * @method Session|null findOneBy(array $criteria, array $orderBy = null)
 * @method Session[]    findAll()
 * @method Session[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }

//    /**
//     * @return Session[] Returns an array of Session objects
//     */

    // création des requêtes personnalisées pour les sessions passées, en cours et a venir
   public function findSessionTerminees(): array
   {
       return $this->createQueryBuilder('s')
           ->andWhere('s.dateFin < CURRENT_DATE()')
           ->getQuery()
           ->getResult()
       ;
   }

   public function findSessionEnCours(): array
   {
       return $this->createQueryBuilder('s')
           ->andWhere('s.dateDebut < CURRENT_DATE()')
           ->andWhere('s.dateFin > CURRENT_DATE()')
           ->getQuery()
           ->getResult()
       ;
   }

   public function findSessionAVenir(): array
   {
       return $this->createQueryBuilder('s')
           ->andWhere('s.dateDebut > CURRENT_DATE()')
           ->getQuery()
           ->getResult()
       ;
   }

   public function findAllStagiairesNonInscrit($idSession): array
    {
        $em = $this->getEntityManager();
        // crée un constructeur de requete pour récupérer des objets
        $requete = $em->createQueryBuilder();
        $qb = $requete;
        // sélectionner tout les stagiaires d'une session dont l'id est passé en paramètre
        $qb->select('s')
            // on selectionne toutes les colones de stagiaire
            ->from('App\Entity\Stagiaire','s')
            // on selectionne les stagiaires dans La session
            ->leftJoin('s.sessions', 'se')
            ->where('se.id = :id');

        // on cherche les stagiaires non inscrit    
        $requete = $em->createQueryBuilder();
        $requete->select('st')
        ->from('App\Entity\Stagiaire', 'st')
        // l'expression (les résultats) de la requete actuelle ne sont pas dans les résultats la requete precedente (qb)
        ->where($requete->expr()->NotIn('st.id', $qb->getDQL()))
        ->setParameter(':id', $idSession);
        // renvoi le resultat
        $query = $requete->getQuery();
        return $query->getResult();
    }


    public function findAllMatieresNonProgrammees($idSession): array
    {
        $em = $this->getEntityManager();
        // crée un constructeur de requete pour récupérer des objets
        $requete = $em->createQueryBuilder();
        $qb = $requete;
        // sélectionner tout les matiers d'une session dont l'id est passé en paramètre
        $qb->select('m')
            // on selectionne toutes les colones de matiere
            ->from('App\Entity\Matiere','m')
            // on selectionne les matieres dans programme
            ->leftJoin('m.programmes', 'p')
            // condition ou l'id de la session dans programme correspond à :id
            ->where('p.session = :id');

        // on cherche les matieres non inscrites   
        $requete = $em->createQueryBuilder();
        $requete->select('ma')
        ->from('App\Entity\Matiere', 'ma')
        // l'expression (les résultats) de la requete actuelle ne sont pas dans les résultats la requete precedente (qb)
        ->where($requete->expr()->NotIn('ma.id', $qb->getDQL()))
        ->setParameter(':id', $idSession);
        // renvoi le resultat
        $query = $requete->getQuery();
        return $query->getResult();
    }
//    faire fonction matiere non inscrite avec l'id de la session
//   créer la premiere querybuilder qui va selectionner les matieres d'une session dont l'id est passé en paramètre
//   selectionner tous les matieres qui ne sont pas dans le resultat de la requete precedente


//    public function findOneBySomeField($value): ?Session
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
