<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticlesType;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    public function __construct(private readonly ManagerRegistry $doctrine){}

    #[Route('/', name: 'app_articles')]
    public function index(): Response
    {
        $getAllArticles = $this->doctrine->getRepository(Article::class)->findAll();

        return $this->render('articles/index.html.twig', [
            'controller_name' => 'ArticlesController',
            'articles' => $getAllArticles,
        ]);
    }

    #[Route('/createArticles', name: 'app_article_create')]
    public function create(Request $request): Response
    {

        $article = new Article();
        $form = $this->createForm(ArticlesType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->doctrine->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('articles');
        }

        return $this->render('articles/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/deleteArticle', name: 'app_article_delete')]
    public function deleteArticleById(Request $request): Response
    {
        $article = $this->doctrine->getRepository(Article::class)->find($request->get('id'));

        $entityManager = $this->doctrine->getManager();
        $entityManager->remove($article);
        $entityManager->flush();

        return $this->redirectToRoute('articles');
    }

    #[Route('/updateArticle/{id}', name: 'app_article_update')]
    public function updateArticleById(Request $request): Response
    {
        $article = $this->doctrine->getRepository(Article::class)->find($request->get('id'));

        $form = $this->createForm(ArticlesType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->doctrine->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('articles');
        }

        return $this->render('articles/updateArticle.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
