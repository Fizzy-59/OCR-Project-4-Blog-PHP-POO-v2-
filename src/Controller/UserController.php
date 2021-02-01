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
        $email = $this->request->request('email');
        $user = $this->entityManager->getRepository(":User")->findOneBy(['email' => $email]);
        if (empty($user)) {
            echo 'Mauvais identifiant ou mot de passe incorrect !';
        } else {
            // Check for match password
            $isPasswordCorrect = password_verify($_POST['password'], $user->getPassword());

            // Start Session
            if ($isPasswordCorrect) {
                $this->session->write('user', $user);

                // Redirect to home
                header("Location: /", 301);
            } else {
                echo 'Mauvais identifiant ou mot de passe incorrect !';
            }
        }
    }

    /**
     * Logout logic
     */
    public function logout()
    {
        $this->session->destroy();

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
        if ($_POST) {


            // Verify if password match
            if ($this->request->request('password1') != $this->request->request('password2')) {
                $error = Error::PASSWORD_ERROR;
                $this->render('login/register.html.twig', ['error' => $error]);
                die();
            }

            $password = $this->request->request('password1');

            // Create new User
            $user = new User();
            $user->setName($this->request->request('name'));
            $user->setEmail($this->request->request('email'));
            $user->setPassword(password_hash($password, PASSWORD_BCRYPT));
            $user->setRole('User');
            $user->setCreatedAt(Carbon::now());

            // Save in Database
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            // Redirect to homePage
            header("Location: /", 301);
        }

        $this->render('login/register.html.twig');
    }


    /**
     * Display forgot password page
     */
    public function forgot()
    {
        $this->render('login/forgot.html.twig');
    }
}