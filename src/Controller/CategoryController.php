<?php


namespace App\Controller;


class CategoryController extends TwigRenderer
{

    public function categories()
    {
        $entityManager = require ROOT_DIR . '/lib/ORM/entityManager.php';

        $categories = $entityManager->getRepository(":Category")->findAll();

        // Render View
        $twig = new TwigRenderer();
        $twig->render('category/categories.html.twig', ['categories' => $categories, 'session' => $_SESSION]);
    }

    /**
     * Display Articles by Category
     */
    public function articleByCategory()
    {
        $id = $_GET['id'];
        $entityManager = require ROOT_DIR . '/lib/ORM/entityManager.php';

        $category = $entityManager->getRepository(":Category")->find($id);

        // Render View
        $twig = new TwigRenderer();
        $twig->render('article/relationArticles.html.twig', ['category' => $category, 'session' => $_SESSION]);
    }

}