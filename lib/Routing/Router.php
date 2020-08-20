<?php


namespace Blog\Routing;



use Blog\Security\Firewall;

class Router
{
    private static $routes = [];

    public static function add($url, $action)
    {
        self::$routes[$url] = $action;
    }

    public static function match($url)
    {
        $url = (empty($url)) ? '/' : $url ;

        foreach (self::$routes as $pattern => $route)
        {
            if(preg_match('#^'.$pattern.'$#', $url))
            {
                Firewall::check($url);

                $controller = 'App\\Controller\\'.ucfirst($route['controller']).'Controller';
                $controller = new $controller();

                return call_user_func_array([$controller, $route['action']], $_GET);
            }
        }
        // TODO : Fix exception
        header('HTTP/1.0 404 not found');
        throw new \Exception('Not found.', 400);
    }

}