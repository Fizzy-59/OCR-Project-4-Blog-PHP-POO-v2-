<?php


namespace App\Controller;


use App\utils\Error;
use Blog\Core\AbstractController;
use Blog\Validator\Validator;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class HomeController extends AbstractController
{
    /**
     * Render view for Home
     */
    public function displayHelloPage()
    {
        $this->render('home/hello.html.twig');
    }

    public function contactForm()
    {
        // Config constants
        require '../config/swiftMailer.php';

        if ($this->request->isMethod('POST')) {
            $name = $this->request->request('name');
            if (Validator::isEmpty($name)) $errors[] = Error::NAME_ERROR;
            if (Validator::checkMinMaxSmall($name)) $errors[] = Error::NAME_LENGHT_ERROR;

            $email = $this->request->request('email');
            if (Validator::isNotAnEmail($email)) $errors[] = Error::EMAIL_ERROR;

            $content = $this->request->request('message');
            if (Validator::isEmpty($content)) $errors[] = Error::COMMENT_ERROR;
            if (Validator::checkMinMaxBig($content)) $errors[] = Error::CONTENT_LENGHT_ERROR;

            // Handle errors
            if ($errors) {
                $this->render('home/hello.html.twig',
                    [
                        'errors' => $errors,
                        'name' => $name,
                        'email' => $email,
                        'content' => $content
                    ]);
            } else {
                // Create the Transport
                $transport = (new Swift_SmtpTransport(EMAIL_HOST, EMAIL_PORT, EMAIL_ENCRYPTION))
                    ->setUsername(EMAIL_USERNAME)
                    ->setPassword(EMAIL_PASSWORD);

                // Create the Mailer using your created Transport
                $mailer = new Swift_Mailer($transport);

                // Create a message
                $message = (new Swift_Message(MESSAGE))
                    ->setFrom([$email => $name])
                    ->setTo([EMAIL_ADDRESS])
                    ->setBody($content);

                // Send the message
                $mailer->send($message);

                // Redirect to home
                header("Location: /", 301);
            }
        }
    }
}