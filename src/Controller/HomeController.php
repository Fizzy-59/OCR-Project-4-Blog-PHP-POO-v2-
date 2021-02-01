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

        $name    = $this->request->request('name');
        $email   = $this->request->request('email');
        $content = $this->request->request('message');

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