<?php


namespace App\Controller;


use App\Entity\Article;
use App\utils\GenerateFake;
use Carbon\Carbon;

class AdminController extends TwigRenderer
{
    /**
     *  Generate fake data for all Entities + linked together
     *  Warning : Don't change ORDER
     */
    public function generateData()
    {
        $data = new GenerateFake();
        $data->generateUser();
        $data->generateCategory();
        $data->generateArticle();
        $data->generateComment();

        // Render view
        $twig = new TwigRenderer();
<<<<<<< HEAD
        $twig->render('admin/faker/faker.html.twig');
=======
        $twig->render('admin/faker/faker.html.twig', ['session' => $_SESSION]);
>>>>>>> front
    }

    public function admin()
    {
        $twig = new TwigRenderer();
<<<<<<< HEAD
        $twig->render('admin/faker.html.twig');
=======
        $twig->render('admin/faker.html.twig', ['session' => $_SESSION]);
>>>>>>> front
    }

    /**
     * Admin view for validate/refuse comment
     */
    public function displayModerateComment()
    {
        $this->entityManager = require ROOT_DIR . '/lib/ORM/entityManager.php';

        // Recover comments
        $comments = $this->entityManager->getRepository(":Comment")->findBy(['validate' => false]);

        // Render View
        $twig = new TwigRenderer();
<<<<<<< HEAD
        $twig->render('admin/comment/moderateComment.html.twig', ['comments' => $comments]);
=======
        $twig->render('admin/comment/moderateComment.html.twig', ['comments' => $comments, 'session' => $_SESSION]);
>>>>>>> front
    }

    /**
     * Admin logic for approve or delete a pending comment
     */
    public function moderate()
    {
        $this->entityManager = require ROOT_DIR . '/lib/ORM/entityManager.php';

        $response = $_POST['validate'];
        $commentId = $_POST['id'];

        // Recover comment linked to request
        $comment = $this->entityManager->getRepository(":Comment")->findOneById($commentId);

        // Determinate what buttons is pressed
        if($response == 1 )
        {
            $comment->setValidate(1);

            // Save in Database
            $this->entityManager->persist($comment);
            $this->entityManager->flush();
        } else {
            // Delete Comment & save database
            $this->entityManager->remove($comment);
            $this->entityManager->flush();
        }

        // Recover comments
        $comments = $this->entityManager->getRepository(":Comment")->findBy(['validate' => false]);

        // Render View
        $twig = new TwigRenderer();
<<<<<<< HEAD
        $twig->render('admin/comment/moderateComment.html.twig', ['comments' => $comments]);
=======
        $twig->render('admin/comment/moderateComment.html.twig', ['comments' => $comments, 'session' => $_SESSION]);
>>>>>>> front
    }

    /**
     * Admin logic for Add Article
     */
    public function addArticle()
    {
        // TODO : Need to Auth

        $this->entityManager = require ROOT_DIR . '/lib/ORM/entityManager.php';

        // Recover Admin
        $userId = $_SESSION['id'];
        $user = $this->entityManager->getRepository(":User")->findOneById($userId);

        $title = $_POST['title'];
        $introduction = $_POST['introduction'];
        $content = $_POST['content'];

        // Recover Category for link her to Article
        $categoryName = $_POST['category'];
        $category = $this->entityManager->getRepository(":Category")->findOneByName($categoryName);

        $user = $this->entityManager->getRepository(":User")->findOneById(23);

        // Set new Article
        $article = new Article();
        $article->setTitle($title);
        $article->setIntroduction($introduction);
        $article->setContent($content);
        $article->setCreated(Carbon::now());
        $article->setCategory($category);
        $article->setUser($user);

        // Save in Database
        $this->entityManager->persist($article);
        $this->entityManager->flush();

        // Render View
        $twig = new TwigRenderer();
<<<<<<< HEAD
        $twig->render('home/home.html.twig');
=======
        $twig->render('home/home.html.twig', ['session' => $_SESSION]);
>>>>>>> front
    }

    /**
     *
     */
    public function displayAddArticle()
    {
        $this->entityManager = require ROOT_DIR . '/lib/ORM/entityManager.php';

        // Recover Categories
        $allCategories = $this->entityManager->getRepository(":Category")->findAll();

        // Render View
        $twig = new TwigRenderer();
<<<<<<< HEAD
        $twig->render('admin/article/addArticle.html.twig', ['allCategories' => $allCategories]);
=======
        $twig->render('admin/article/addArticle.html.twig', ['allCategories' => $allCategories, 'session' => $_SESSION]);
>>>>>>> front
    }

    public function updateArticle()
    {
        $this->entityManager = require ROOT_DIR . '/lib/ORM/entityManager.php';

        $title = $_POST['title'];
        $introduction = $_POST['introduction'];
        $content = $_POST['content'];

        // Recover Category for link her to Article
        $categoryName = $_POST['category'];
        $category = $this->entityManager->getRepository(":Category")->findOneByName($categoryName);

        // Update Article
        $article->setTitle($title);
        $article->setIntroduction($introduction);
        $article->setContent($content);
        $article->setCategory($category);

        // Save in Database
        $this->entityManager->persist($article);
        $this->entityManager->flush();



    }

    public function displayUpdateArticle()
    {
        $this->entityManager = require ROOT_DIR . '/lib/ORM/entityManager.php';

        // Recover Categories
        $allCategories = $this->entityManager->getRepository(":Category")->findAll();

        // Recover Article
        $article = $this->entityManager->getRepository(":Article")->findOneById($articleId);


        // Render View
        $twig = new TwigRenderer();
        $twig->render('article/updateArticle.html.twig',
            [
                'allCategories' => $allCategories,
                'title' => $title,
                'introduction' => $introduction,
<<<<<<< HEAD
                'content' => $content
=======
                'content' => $content,
                'session' => $_SESSION
>>>>>>> front
            ]);

    }
}