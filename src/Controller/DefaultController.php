<?php


namespace App\Controller;


class DefaultController extends TwigRenderer
{

    public function home() {
        $twig = new TwigRenderer();
        $twig->render('base.html.twig', ['the' => 'variables', 'go' => 'here']);

    }

    public function test() {
        $twig = new TwigRenderer();
        $twig->render('base.html.twig', ['the' => 'variables', 'go' => 'here']);
    }

    public function admin() {
        $twig = new TwigRenderer();
        $twig->render('admin/faker.html.twig', ['the' => 'variables', 'go' => 'here']);

    }
}