<?php


namespace App\Controller;



use App\Entity\Comment;
use App\utils\GenerateFake;

class DefaultController extends TwigRenderer
{

    /**
     * Homepage, display Article + Category
     */
    public function home()
    {
        $entityManager = require ROOT_DIR.'/lib/ORM/entityManager.php';

        $categories = $entityManager->getRepository(":Category")->findAll();
        $articles = $entityManager->getRepository(":Article")->findAll();

        $twig = new TwigRenderer();
        $twig->render('home/home.html.twig', ['categories' => $categories, 'articles' => $articles]);
    }

    /**
     * Display one Article
     */
    public function singleArticle()
    {
        $id = $_GET['id'];
        $entityManager = require ROOT_DIR.'/lib/ORM/entityManager.php';

        $article = $entityManager->getRepository(":Article")->findOneById($id);

        $twig = new TwigRenderer();
        $twig->render('article/singleArticle.html.twig', ['article' => $article]);
    }

    /**
     * Display Articles by Category
     */
    public function articleByCategory()
    {
        $id = $_GET['id'];
        $entityManager = require ROOT_DIR.'/lib/ORM/entityManager.php';

        $category = $entityManager->getRepository(":Category")->find($id);

        $twig = new TwigRenderer();
        $twig->render('article/relationArticles.html.twig', ['category' => $category]);
    }

    public function test() {}

    /**
     * User add comment, pending for moderate
     */
    public function addComment()
    {
        $this->entityManager = require ROOT_DIR.'/lib/ORM/entityManager.php';

        $content = $_POST['comment'];

        $comment = new Comment();
        $comment->setContent($content);
        $comment->setValidate(false);

    }

    // ADMIN

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

        $twig = new TwigRenderer();
        $twig->render('admin/faker/faker.html.twig');
    }

    public function admin() {
        $twig = new TwigRenderer();
        $twig->render('admin/faker.html.twig', ['the' => 'variables', 'go' => 'here']);
    }

    /**
     * Admin validate/refuse comment
     */
    public function moderateComment() {

    }
}