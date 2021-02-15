<?php


namespace Blog\Routing;



use Blog\Http\Request;
use Blog\Security\Firewall;

class Router
{
    private static $routes = [];

    public static function add($url, $action)
    {
        self::$routes[$url] = $action;
    }

    public static function match(Request $request)
    {
        $url = $request->server('PATH_INFO');
        $url = (empty($url)) ? '/' : $url ;

        foreach (self::$routes as $pattern => $route)
        {
            if(preg_match('#^'.$pattern.'$#', $url))
            {
                Firewall::check($url, $request);

                $controller = 'App\\Controller\\'.ucfirst($route['controller']).'Controller';
                $controller = new $controller($request);

                return call_user_func_array([$controller, $route['action']], $_GET);
            }
        }
        header("Location: /", 301);
    }
}