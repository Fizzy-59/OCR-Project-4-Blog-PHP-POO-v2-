<?php


namespace Blog\Security;


use Blog\Core\Configuration;
use Blog\Http\Request;

class Firewall
{
    /**
     * Check role
     *
     * @param $url
     * @return bool
     * @throws \Exception
     */
    public static function check(string $url, Request $request)
    {
        // https://github.com/adbario/php-dot-notation
        $access = Configuration::read('security.access');

        foreach ($access as $pattern => $role) {
            if(preg_match('#^'.$pattern.'#', $url) && $request->session()->read('user')->getRole() !== $role) {
                throw new \Exception('Unauthorized', 401);
            }
        }
        return true;
    }
}