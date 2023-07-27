<?php

namespace App\Controller;

use App\Entity\Stagiaire;
use App\Form\StagiaireType;
use App\Repository\StagiaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/stagiaire/new', name: 'new_stagiaire')]
    #[Route('/stagiaire/{id}/edit}', name: 'edit_stagiaire')]
    public function new(Stagiaire $stagiaire = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        // si la session n'existe pas
        if(!$stagiaire) {
        // on crée un nouvel objet stagiaire
        $stagiaire = new Stagiaire();
        }

        // on crée un formuilaire
        $form = $this->createForm(StagiaireType::class, $stagiaire);

        // prise en charge de la requête
        $form->handleRequest($request);

        // si le formaulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            
            // on récupère les données du formaulaire
            $stagiaire = $form->getData();

            // équivalent de prepare en PDO
            $entityManager->persist($stagiaire);

            // équivalent d'execute en PDO
            $entityManager->flush();

            return $this->redirectToRoute('app_stagiaire');
        }

        return $this->render('stagiaire/new.html.twig', [
            'formAddStagiaire' => $form,
            // renvoi faux ou l'id s'il existe
            'edit' => $stagiaire->getId()
        ]);
    }

    #[Route('/stagiaire/{id}/delete', name: 'delete_stagiaire')]
    // EntityManagerInterface gère l'interaction avec la BDD
    public function delete(Stagiaire $stagiaire, EntityManagerInterface $entityManager)
    {
        // prépare à la suppression
        $entityManager->remove($stagiaire);
        //execute la requête
        $entityManager->flush();

        return $this->redirectToRoute('app_stagiaire');
    }

    #[Route('/stagiaire/{id}', name: 'showDetail_stagiaire')]
    public function showDetail(Stagiaire $stagiaire): Response
    {
        return $this->render('stagiaire/showDetail.html.twig', [
            'stagiaire' => $stagiaire,
        ]); 
    }
}
