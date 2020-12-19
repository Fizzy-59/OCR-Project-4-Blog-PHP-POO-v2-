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

    /**
     * Render function using Twig templating
     *
     * @param $view
     * @param array $params
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    protected function render($view, $params = [])
    {
        $loader = new FilesystemLoader(ROOT_DIR.'/templates');
        $twig = new Environment($loader);
        $twig->addGlobal('session', $_SESSION);
        $template = $twig->load($view);

        echo $template->render($params);
    }

}