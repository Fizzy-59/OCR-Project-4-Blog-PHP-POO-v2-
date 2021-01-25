<?php


namespace App\Controller;


use Blog\Core\AbstractController;
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

        $name = $_POST['name'];
        $email = $_POST['email'];
        $content = $_POST['message'];

        // Create the Transport
        $transport = (new Swift_SmtpTransport(EMAIL_HOST, EMAIL_PORT, EMAIL_ENCRYPTION))
            ->setUsername(EMAIL_USERNAME)
            ->setPassword(EMAIL_PASSWORD);

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message('Message from Blog'))
            ->setFrom([$email => $name])
            ->setTo(['contact@blogocr.devillezdeveloppement.info'])
            ->setBody($content);

        // Send the message
        $mailer->send($message);
    }
}