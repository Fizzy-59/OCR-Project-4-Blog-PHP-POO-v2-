<?php


namespace App\Controller;



class DefaultController extends TwigRenderer
{
    /**
     * Homepage, display Article + Category
     */
    public function home()
    {
        $entityManager = require ROOT_DIR . '/lib/ORM/entityManager.php';

        $categories = $entityManager->getRepository(":Category")->findAll();
        $articles = $entityManager->getRepository(":Article")->findAll();

        $twig = new TwigRenderer();
        $twig->render('home/home.html.twig', ['categories' => $categories, 'articles' => $articles]);
    }


}