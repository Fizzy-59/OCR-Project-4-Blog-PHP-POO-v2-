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
        if (Validator::isNotAnEmail($email)) $errors[] = Error::USER_NOT_FOUND;

        $password = $this->request->request('password');
        if (Validator::checkMinMaxSmall($password)) $errors[] = Error::USER_NOT_FOUND;

        $user = $this->entityManager->getRepository(":User")->findOneBy(['email' => $email]);
        if (empty($user)) $errors[] = Error::USER_NOT_FOUND;

        $matchPassword = $user->getPassword();
        if ($matchPassword != null) $isPasswordCorrect = password_verify($password, $matchPassword);

        if (!$isPasswordCorrect) $errors[] = Error::USER_NOT_FOUND;

        if($errors) {
            $this->render('home/hello.html.twig', ['errors' => $errors[0]]);
        } else {
            $this->session->write('user', $user);
            header("Location: /", 301);
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
     * Register logic for save a new User
     */
    public function registration()
    {
        if ($_POST) {
            $name = $this->request->request('name');
            if (Validator::isEmpty($name)) $errors[] = Error::NAME_ERROR;
            if (Validator::checkMinMaxSmall($name)) $errors[] = Error::NAME_LENGHT_ERROR;

            $email = $this->request->request('email');
            if (Validator::isNotAnEmail($email)) $errors[] = Error::EMAIL_ERROR;
            $emailExist = $this->entityManager->getRepository(":User")->findOneBy(['email' => $email]);
            if ($emailExist) $errors[] = Error::EMAIL_EXIST;

            $password1 = $this->request->request('password1');
            $password2 = $this->request->request('password2');
            // Verify if password match
            if ($password1 != $password2) {
                $errors[] = Error::PASSWORD_ERROR;
            }
            if (Validator::checkMinMaxSmall($password1)) $errors[] = Error::PASSWORD_LENGHT_ERROR;

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