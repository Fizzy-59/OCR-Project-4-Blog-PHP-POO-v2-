<?php


namespace App\Controller;


use Blog\Core\AbstractController;

class HomeController extends AbstractController
{
    /**
     * Render view for Home
     */
    public function displayHelloPage()
    {
        $this->render('home/hello.html.twig');
    }
}