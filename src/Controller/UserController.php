<?php


namespace App\Controller;


use App\Entity\User;
use App\utils\Error;
use Blog\Core\AbstractController;
use Carbon\Carbon;

class UserController extends AbstractController
{
    /**
     * Connection logic to simple User or Admin
     */
    public function connection()
    {
        // Recover User
        $email = $_POST['email'];
        $user = $this->entityManager->getRepository(":User")->findOneBy(['email' => $email]);

        if (empty($user))
        {
            echo 'Mauvais identifiant ou mot de passe user vide !'; }
        else {
            // Check for match password
            $isPasswordCorrect = password_verify($_POST['password'], $user->getPassword());

            // TODO : check for class session
            // Start Session
            if ($isPasswordCorrect) {
                session_start();
                $_SESSION['id'] = $user->getId();
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $user->getName();
                $_SESSION['role'] = $user->getRole();

                $this->render('home/home.html.twig', ['session' => $_SESSION]);
            } else {
                echo 'Mauvais identifiant ou mot de passe ident pas bon !';
            }
        }
    }

    /**
     * Display login page
     */
    public function login()
    {
        $this->entityManager = require ROOT_DIR . '/lib/ORM/entityManager.php';
        $twig = new TwigRenderer();
        $twig->render('login/login.html.twig', ['session' => $_SESSION]);
    }

    public function logout()
    {
        session_destroy();

        header("Location: /", 301);
    }


    /**
     * Register Logic
     */
    public function register()
    {
        $this->entityManager = require ROOT_DIR . '/lib/ORM/entityManager.php';

        // Render View
        $twig = new TwigRenderer();
        $twig->render('login/register.html.twig', ['session' => $_SESSION]);
    }

    public function registration()
    {
        $this->entityManager = require ROOT_DIR . '/lib/ORM/entityManager.php';

        // Verify if password match
        if ($_POST['password1'] != $_POST['password2']) {
            $error = Error::PASSWORD_ERROR;
            $twig = new TwigRenderer();
            $twig->render('login/register.html.twig', ['error' => $error, 'session' => $_SESSION]);
            die();
        }

        $password = $_POST['password1'];

        // Create new User
        $user = new User();
        $user->setName($_POST['name']);
        $user->setEmail($_POST['email']);
        $user->setPassword(password_hash($password, PASSWORD_BCRYPT));
        $user->setRole('User');
        $user->setCreated(Carbon::now());

        // Save in Database
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        // Render View
        $twig = new TwigRenderer();
        $twig->render('login/login.html.twig', ['session' => $_SESSION]);
    }

}