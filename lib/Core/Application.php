<?php


namespace Blog\Core;


use Blog\Http\Request;
use Blog\Routing\Router;
use Symfony\Component\Dotenv\Dotenv;

class Application
{

    /**
     *
     *
     */
    public function bootstrap()
    {
        $dotenv = new Dotenv();
        $dotenv->load(ROOT_DIR.'/.env');

        // TODO : new Configuration
        Configuration::config();
    }

    public function run()
    {
        $request = new Request();
        return Router::match($request->server('PATH_INFO') );

    }
}