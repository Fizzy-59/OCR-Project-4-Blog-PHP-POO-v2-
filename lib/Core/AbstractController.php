<?php


namespace Blog\Core;


use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class AbstractController
{
    protected $entityManager;

    public function __construct()
    {
        $this->entityManager = require ROOT_DIR . '/lib/ORM/entityManager.php';

    }

    protected function render($view, $params = [])
    {
        $loader = new FilesystemLoader(ROOT_DIR.'/templates');
        $twig = new Environment($loader);
        $template = $twig->load($view);

        echo $template->render($params);
    }

}