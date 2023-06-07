<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Form\AuteursType;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AuteursController extends AbstractController
{
    public function __construct(private readonly ManagerRegistry $doctrine)
    {
    }

    #[Route('/auteurs', name: 'app_auteurs')]
    public function index(): Response
    {
        $getAllAuteurs = $this->doctrine->getRepository(Auteur::class)->findAll();
        return $this->render('auteurs/index.html.twig', [
            'controller_name' => 'AuteursController',
            'auteurs' => $getAllAuteurs,
        ]);
    }

    #[Route('/auteurs/create', name: 'app_auteur_create')]
    public function create(Request $request): Response
    {
        $auteur = new Auteur();
        $form = $this->createForm(AuteursType::class, $auteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->doctrine->getManager();
            $entityManager->persist($auteur);
            $entityManager->flush();

            return $this->redirectToRoute('app_auteurs');
        }

        return $this->render('auteurs/createAuteur.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/updateauteur/{id}', name: 'app_auteur_show')]
    public function updateUserById(Request $request): Response
    {
        $auteur = $this->doctrine->getRepository(Auteur::class)->find($request->get('id'));

        $form = $this->createForm(AuteursType::class, $auteur);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->doctrine->getManager();
            $entityManager->persist($auteur);
            $entityManager->flush();

            return $this->redirectToRoute('app_auteurs');
        }

        return $this->render('auteurs/updateAuteur.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
