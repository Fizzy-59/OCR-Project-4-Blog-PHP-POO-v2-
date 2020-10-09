<?php


namespace App\Controller;


use Twig\Environment;
use Twig\Loader\FilesystemLoader;

 class TwigRenderer
{
    protected function render($view, $params = [])
    {
        $loader = new FilesystemLoader(ROOT_DIR.'/templates');
        $twig = new Environment($loader);

        $template = $twig->load($view);
        echo $template->render($params);
    }
}