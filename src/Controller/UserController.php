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

        if (empty($user)) {
            echo 'Mauvais identifiant ou mot de passe incorrect !';
        } else {
            // Check for match password
            $isPasswordCorrect = password_verify($_POST['password'], $user->getPassword());

            // Start Session
            if ($isPasswordCorrect) {
                session_start();
                $_SESSION['id'] = $user->getId();
                $_SESSION['name'] = $user->getName();
                $_SESSION['role'] = $user->getRole();
                $_SESSION['email'] = $email;

                // Redirect to home
                header("Location: /", 301);
            } else {
                echo 'Mauvais identifiant ou mot de passe incorrect !';
            }
        }
    }

    /**
     * Display login page
     */
    public function login()
    {
        $this->render('login/login.html.twig');
    }

    /**
     * Logout logic
     */
    public function logout()
    {
        session_destroy();

        // Redirect to home
        header("Location: /", 301);
    }

    /**
     * Display register page
     */
    public function register()
    {
        $this->render('login/register.html.twig');
    }

    /**
     * Register logic for save a new User
     */
    public function registration()
    {
        // Verify if password match
        if ($_POST['password1'] != $_POST['password2']) {
            $error = Error::PASSWORD_ERROR;
            $this->render('login/register.html.twig', ['error' => $error]);
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

        // Redirect to homePage
        header("Location: /", 301);
    }
}