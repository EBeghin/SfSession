<?php

namespace App\Controller;

use App\Entity\Session;
use App\Form\SessionType;
use App\Repository\SessionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(SessionRepository $sessionRepository): Response
    {
        $sessions = $sessionRepository->findBy([],["dateDebut" => "ASC"]);
        return $this->render('session/index.html.twig', [
            'sessions' => $sessions,
        ]);
    }
    
    #[Route('/session/new', name: 'new_session')]
    #[Route('/session/{id}/edit', name: 'edit_session')]
    public function new_edit(Session $session = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        // si la session n'existe pas
        if(!$session) {
            // on crée un nouvel objet session
            $session = new Session();
        }

        // on crée un formuilaire
        $form = $this->createForm(SessionType::class, $session);

        // prise en charge de la requête
        $form->handleRequest($request);

        // si le formaulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            
            // on récupère les données du formaulaire
            $session = $form->getData();

            // équivalent de prepare en PDO
            $entityManager->persist($session);

            // équivalent d'execute en PDO
            $entityManager->flush();

            return $this->redirectToRoute('app_session');
        }

        return $this->render('session/new.html.twig', [
            'formAddSession' => $form,
            // renvoi faux ou l'id s'il existe
            'edit' => $session->getId()
        ]);
    }
    
    #[Route('/session/{id}/delete', name: 'delete_session')]
    // EntityManagerInterface gère l'interaction avec la BDD
    public function delete(Session $session, EntityManagerInterface $entityManager)
    {
        // prépare à la suppression
        $entityManager->remove($session);
        //execute la requête
        $entityManager->flush();

        return $this->redirectToRoute('app_session');
    }

    #[Route('/session/{id}', name: 'showDetail_session')]
    public function showDetail(Session $session): Response
    {
        return $this->render('session/showDetail.html.twig', [
            'session' => $session,
        ]); 
    }

}
