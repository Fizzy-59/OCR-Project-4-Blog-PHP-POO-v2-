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
        $id = $this->request->query('id');
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
        $articles = $this->entityManager->getRepository(":Article")->findBy([], ['createdAt' => 'DESC']);

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
        // Recover comment
        $content = $this->request->request('comment');

        // Recover Article
        $articleId = $this->request->request('articleId');
        $article = $this->entityManager->getRepository(":Article")->findOneById($articleId);

        // Recover UserId
        $userId =  $this->session->read('user')->getId();
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