<?php


namespace App\Controller;


class HomeController extends TwigRenderer
{
    public function displayHelloPage()
    {

        $twig = new TwigRenderer();
        $twig->render('home/hello.html.twig', ['session' => $_SESSION]);

    }

}