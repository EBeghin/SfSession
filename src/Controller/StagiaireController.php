<?php

namespace App\Controller;

use App\Entity\Stagiaire;
use App\Repository\StagiaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StagiaireController extends AbstractController
{
    #[Route('/stagiaire', name: 'app_stagiaire')]
    // public function index(EntityManagerInterface $entityManager): Response
    // privilégier de faire passer le repository
    public function index(StagiaireRepository $stagiaireRepository): Response

    {
        // récupération de toutes les entreprises de la BDD
        // $stagiaires = $entityManager->getRepository(Stagiaire::class)->findAll();
        // on trie les noms par ordre ascendant avec findBy (2eme option des arguments)
        $stagiaires = $stagiaireRepository->findBy([],["nom" => "ASC"]);

        // envoi des entreprises dans la vue
        return $this->render('stagiaire/index.html.twig', [
            'stagiaires' => $stagiaires,
        ]);
    }

    #[Route('/stagiaire/{id}', name: 'showDetail_stagiaire')]
    public function showDetail(Stagiaire $stagiaire): Response
    {
        return $this->render('stagiaire/showDetail.html.twig', [
            'stagiaire' => $stagiaire,
        ]); 
    }
}
