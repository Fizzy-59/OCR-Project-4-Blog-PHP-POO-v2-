<?php


namespace App\utils;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\User;
use Faker\Factory;

require ROOT_DIR.'/vendor/autoload.php';

class GenerateFake
{

    private $faker;
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = require ROOT_DIR.'/lib/ORM/entityManager.php';
        $this->faker = Factory::create();
    }

    /**
     * Generate fake data for User
     */
    public function generateUser()
    {
        // Generate title
        for ($i = 0; $i < 5; $i++)
        {
            $user = New User();

            // Genrate Name
            $name = $this->faker->firstName();
            $user->setName($name);

            //Generate Role
            $role = $this->faker->word();
            $user->setRole($role);

            // Generate Date
            $date = $this->faker->dateTime();
            $user->setCreated($date);

            $this->entityManager->persist($user);
        }

        // Save in Database
        $this->entityManager->flush($user);

        echo "Generate fake Users... <br>";
    }

    /**
     * Generate fake data for Category
     */
    public function generateCategory()
    {
        // Generate name
        for ($i = 0; $i < 3; $i++)
        {
            $category = new Category();

            $name = $this->faker->word();
            $category->setName($name);

            // Generate Date
            $date = $this->faker->dateTime();
            $category->setCreated($date);

            $this->entityManager->persist($category);
        }

        // Save in Database
        $this->entityManager->flush($category);

        echo "Generate fake Categories... <br>";
    }

    /**
     * Generate fake data for Article + link to User & Category
     */
    public function generateArticle()
    {

        for ($i = 0; $i < 10; $i++) {

            $article = new Article();

            // Generate Title
            $title = $this->faker->paragraph(1, true);
            $article->setTitle($title);

            // Generate Introduction
            $intro = $this->faker->realText(50, 2);
            $article->setIntroduction($intro);

            // Generate Content
            $content = $this->faker->realText(200, 4);
            $article->setContent($content);

            // Link to User
            $nbRandomUser = random_int(1, 5);
            $userRepo = $this->entityManager->getRepository(":User")->findOneById($nbRandomUser);
            $article->setUser($userRepo);

            // Link to Category
            $nbRandomCategory = random_int(1, 3);
            $categoryRepo = $this->entityManager->getRepository(":Category")->findOneById($nbRandomCategory);
            $article->setCategory($categoryRepo);

            // Generate Date
            $date = $this->faker->dateTime();
            $article->setCreated($date);

            $this->entityManager->persist($article);
        }

        // Save in Database
        $this->entityManager->flush($article);

        echo "Generate fake Articles... <br>";
    }

    /**
     * Generate fake data for Comment + link to User & Article
     */
    public function generateComment()
    {
        for ($i = 0; $i < 7; $i++)
        {
        $comment = New Comment();

        // Generate Title
            $title = $this->faker->word();
            $comment->setTitle($title);

        // Generate Comment
            $content = $this->faker->sentence(5, true);
            $comment->setContent($content);

            // Generate Date
            $date = $this->faker->dateTime();
            $comment->setCreated($date);

            // Link to User
            $nbRandomUser = random_int(1, 5);
            $userRepo = $this->entityManager->getRepository(":User")->findOneById($nbRandomUser);
            $comment->setUser($userRepo);

            // Link to Article
            $nbRandomArticle = random_int(1, 10);
            $articleRepo =  $this->entityManager->getRepository(":Article")->findOneById($nbRandomArticle);
            $comment->setArticle($articleRepo);

            // Set Validate on True
            $comment->setValidate(true);

            $this->entityManager->persist($comment);
        }

        // Save in Database
        $this->entityManager->flush($comment);

        echo "Generate fake Comments... <br>";
    }
}