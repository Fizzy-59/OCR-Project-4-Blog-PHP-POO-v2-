<?php


namespace App\Controller;


use Blog\Core\AbstractController;

class CategoryController extends AbstractController
{

    /**
     * Display all Categories
     */
    public function categories()
    {
        $categories = $this->entityManager->getRepository(":Category")->findAll();

        $this->render('category/categories.html.twig', ['categories' => $categories]);
    }

    /**
     * Display Articles by Category
     */
    public function articleByCategory()
    {
        $id = $this->request->query('id');
        $category = $this->entityManager->getRepository(":Category")->find($id);

        $this->render('article/relationArticles.html.twig', ['category' => $category]);
    }
}
