<?php


namespace App\Controller;


use App\Entity\Article;
use App\utils\GenerateFake;
use Blog\Core\AbstractController;
use Carbon\Carbon;

class AdminController extends AbstractController
{
    /**
     * Admin dashboard
     */
    public function dashboard()
    {
        // Recover comments
        $comments = $this->entityManager->getRepository(":Comment")->findBy(['validate' => false]);

        $this->render('admin/dashboard.html.twig', ['comments' => $comments]);
    }

    /**
     * Admin logic for approve or delete a pending comment
     */
    public function moderate()
    {
        $response = $this->request->request('validate');
        $commentId = $this->request->request('id');

        // Recover comment linked to request
        $comment = $this->entityManager->getRepository(":Comment")->findOneById($commentId);

        // Determinate what buttons is pressed
        if ($response == 1) {
            $comment->setValidate(1);

            // Save in Database
            $this->entityManager->persist($comment);
            $this->entityManager->flush();
        } else {
            // Delete Comment & save database
            $this->entityManager->remove($comment);
            $this->entityManager->flush();
        }

        // Redirect to admin Dashboard
        header("Location: /admin/dashboard", 301);
    }

    /**
     * Admin logic for Add Article
     */
    public function addArticle()
    {
        // Recover Admin
        $title = $this->request->request('title');
        $introduction = $this->request->request('introduction');
        $content = $this->request->request('content');

        // Recover Category for link her to Article
        $categoryName = $this->request->request('category');;
        $category = $this->entityManager->getRepository(":Category")->findOneByName($categoryName);

        $user = $this->entityManager->getRepository(":User")->findOneById(23);

        // Set new Article
        $article = new Article();
        $article->setTitle($title);
        $article->setIntroduction($introduction);
        $article->setContent($content);
        $article->setCreatedAt(Carbon::now());
        $article->setUpdatedAt(Carbon::now());
        $article->setCategory($category);
        $article->setUser($user);

        // Save in Database
        $this->entityManager->persist($article);
        $this->entityManager->flush();

        // Redirect to dashboard Article
        header("Location: /articles", 301);
    }

    /**
     * Render view for Add Article
     */
    public function displayAddArticle()
    {
        $allCategories = $this->entityManager->getRepository(":Category")->findAll();

        $this->render('admin/article/addArticle.html.twig', ['allCategories' => $allCategories]);
    }

    /**
     * Display dashboard for update Article
     */
    public function dashboardArticle()
    {
        // Recover articles
        $articles = $this->entityManager->getRepository(":Article")->findAll();

        $this->render('admin/article/dashboardArticle.html.twig', ['articles' => $articles]);
    }

    /**
     * Render view for update article page
     */
    public function displayUpdateArticle()
    {
        $articleId = $this->request->request('articleId');

        // Recover Article
        $article = $this->entityManager->getRepository(":Article")->findOneById($articleId);

        // Recover Categories
        $categories = $this->entityManager->getRepository(":Category")->findAll();

        $this->render('admin/article/updateArticle.html.twig',
            [
                'article' => $article,
                'categories' => $categories
            ]);
    }

    /**
     * Logic for update Article
     */
    public function updateArticle()
    {
        $title = $this->request->request('title');
        $introduction = $this->request->request('introduction');
        $content = $this->request->request('content');

        //Recover article
        $articleId = $this->request->request('articleId');
        $article = $this->entityManager->getRepository(":Article")->findOneById($articleId);

        // Recover Category for link her to Article
        $categoryName = $this->request->request('category');
        $category = $this->entityManager->getRepository(":Category")->findOneByName($categoryName);

        // Update Article
        $article->setTitle($title);
        $article->setIntroduction($introduction);
        $article->setContent($content);
        $article->setCategory($category);
        $article->setUpdatedAt(Carbon::now());

        // Save in Database
        $this->entityManager->persist($article);
        $this->entityManager->flush();

        // Redirect to dashboard Article
        header("Location: /admin/article_dashboard", 301);
    }

    /**
     * Delete Article & comments linked
     */
    public function deleteArticle()
    {
        $articleId = $this->request->request('id');

        $article = $this->entityManager->getRepository(":Article")->findOneById($articleId);
        $comments = $this->entityManager->getRepository(":Comment")->findBy(['article' => $articleId]);

        // Delete All comments linked at the article
        foreach ($comments as $comment ) {
            $this->entityManager->remove($comment);
        }

        // Save in Database
        $this->entityManager->remove($article);
        $this->entityManager->flush();

        header("Location: /admin/article_dashboard", 301);
    }

    /**
     *  Generate fake data for all Entities + linked together
     *  Warning : Don't change ORDER
     *  Access URL : /admin/feed_database
     */
    public function generateData()
    {
        $data = new GenerateFake();
        $data->generateUser();
        $data->generateCategory();
        $data->generateArticle();
        $data->generateComment();
    }
}
