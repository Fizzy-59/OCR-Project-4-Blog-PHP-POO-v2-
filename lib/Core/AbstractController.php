<?php


namespace Blog\Core;


use Blog\Http\Request;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

abstract class AbstractController
{
    protected $entityManager;
    protected $request;
    protected $session;

    public function __construct(Request $request)
    {
        $this->entityManager = require ROOT_DIR . '/lib/ORM/entityManager.php';
        $this->request = $request;
        $this->session = $request->session();
    }

    /**
     * Render function using Twig templating
     *
     * @param $view
     * @param array $params
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    protected function render($view, $params = [])
    {
        $loader = new FilesystemLoader(ROOT_DIR.'/templates');
        $twig = new Environment($loader);

        // Inject session in twig
        $twig->addGlobal('session', $this->session->get());
        $template = $twig->load($view);

        echo $template->render($params);
    }

}