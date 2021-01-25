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
        $name = $_POST['name'];
        $email = $_POST['email'];
        $content = $_POST['content'];

        // Create the Transport
        $transport = (new Swift_SmtpTransport('manioc.o2switch.net
', 465, 'ssl'))
            ->setUsername('contact@blogocr.devillezdeveloppement.info
')
            ->setPassword('OPnfw^l~wj[c');

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message('Message from Blog'))
            ->setFrom([$email => $name])
            ->setTo(['contact@blogocr.devillezdeveloppement.info'])
            ->setBody($content);

        // Send the message
        $result = $mailer->send($message);

    }
}