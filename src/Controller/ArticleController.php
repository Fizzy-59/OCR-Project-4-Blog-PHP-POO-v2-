<?php


namespace App\Controller;


use App\Entity\Comment;
use Blog\Core\AbstractController;
use Carbon\Carbon;

class ArticleController extends AbstractController
{
    /**
     * Display one Article
     */
    public function article()
    {
        $id = $_GET['id'];
        $article = $this->entityManager->getRepository(":Article")->findOneById($id);

        // Render View
        $this->render('article/article.html.twig', ['article' => $article]);
    }

    /**
     * Display all Articles
     */
    public function articles()
    {
        $categories = $this->entityManager->getRepository(":Category")->findAll();
        $articles = $this->entityManager->getRepository(":Article")->findAll();

        $this->render('article/articles.html.twig',
            [
                'categories' => $categories,
                'articles' => $articles,
            ]);
    }

    /**
     * User add comment, pending for moderate
     */
    public function addComment()
    {
        $content = $_POST['comment'];

        // Recover Article
        $articleId = (int)$_POST['articleId'];
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
        $this->render('article/article.html.twig', ['article' => $article]);
    }
}