<?php


namespace App\Controller;


use App\Entity\Comment;
use Carbon\Carbon;

class ArticleController extends TwigRenderer
{
    /**
     * Display one Article
     */
    public function singleArticle()
    {
        $id = $_GET['id'];
        $entityManager = require ROOT_DIR . '/lib/ORM/entityManager.php';

        $article = $entityManager->getRepository(":Article")->findOneById($id);

        // Render View
        $twig = new TwigRenderer();
        $twig->render('article/singleArticle.html.twig', ['article' => $article, 'session' => $_SESSION]);
    }

    /**
<<<<<<< HEAD
     * Display Articles by Category
     */
    public function articleByCategory()
    {
        $id = $_GET['id'];
        $entityManager = require ROOT_DIR . '/lib/ORM/entityManager.php';

        $category = $entityManager->getRepository(":Category")->find($id);

        // Render View
        $twig = new TwigRenderer();
        $twig->render('article/relationArticles.html.twig', ['category' => $category]);
    }

    /**
=======
>>>>>>> front
     * User add comment, pending for moderate
     */
    public function addComment()
    {
        $this->entityManager = require ROOT_DIR . '/lib/ORM/entityManager.php';

        $content = $_POST['comment'];

        // Recover Article
        $articleId = (int) $_POST['articleId'];
        $article = $this->entityManager->getRepository(":Article")->findOneById($articleId);

        // Recover User
        $userId = $_SESSION['id'];
        $user = $this->entityManager->getRepository(":User")->findOneById($userId);

        // Add new Comment
        $comment = new Comment();
        $comment->setUser($user);
        $comment->setContent($content);
        $comment->setArticle($article);
        $comment->setValidate(false);
        $comment->setCreated(Carbon::now());

        // Save in Database
        $this->entityManager->persist($comment);
        $this->entityManager->flush($comment);

        // Render View
        $twig = new TwigRenderer();
        $twig->render('article/singleArticle.html.twig', ['article' => $article, 'session' => $_SESSION]);
    }
}