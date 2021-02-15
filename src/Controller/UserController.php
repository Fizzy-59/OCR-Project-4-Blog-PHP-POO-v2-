<?php


namespace App\Controller;


use App\Entity\User;
use App\utils\Error;
use Blog\Core\AbstractController;
use Blog\Validator\Validator;
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
        $password = $this->request->request('password');
        $user = $this->entityManager->getRepository(":User")->findOneBy(['email' => $email]);

        if (empty($user)) {
            echo 'Mauvais identifiant ou mot de passe incorrect !';
        } else {
            // Check for match password
            $isPasswordCorrect = password_verify($password, $user->getPassword());

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
            $name = $this->request->request('name');
            if (Validator::isEmpty($name)) {
                $errors[] = Error::NAME_ERROR;
            }

            $email = $this->request->request('email');
            if (Validator::isNotAnEmail($email)) {
                $errors[] = Error::EMAIL_ERROR;
            }

            $password1 = $this->request->request('password1');
            $password2 = $this->request->request('password2');
            // Verify if password match
            if ($password1 != $password2) {
                $errors[] = Error::PASSWORD_ERROR;
            }

            // Handle errors
            if ($errors) $this->render('login/register.html.twig',
                [
                    'errors' => $errors,
                    'name' => $name,
                    'email' => $email
                ]);

            $password = $this->request->request('password1');

            // Create new User
            $user = new User();
            $user->setName($name);
            $user->setEmail($email);
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