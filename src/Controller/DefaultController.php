<?php


namespace App\Controller;



use App\utils\GenerateFake;

class DefaultController extends TwigRenderer
{

    public function home() {
        $twig = new TwigRenderer();
        $twig->render('base.html.twig', ['the' => 'variables', 'go' => 'here']);

    }

    public function test() {


    }

    public function admin() {
        $twig = new TwigRenderer();
        $twig->render('admin/faker.html.twig', ['the' => 'variables', 'go' => 'here']);

    }

    /**
     * Generate fake data for all Entities + linked together
     */
    public function generateData()
    {
        $data = new GenerateFake();
        $data->generateUser();
        $data->generateCategory();
        $data->generateArticle();
        $data->generateComment();

        $twig = new TwigRenderer();
        $twig->render('admin/faker/faker.html.twig');

    }
}