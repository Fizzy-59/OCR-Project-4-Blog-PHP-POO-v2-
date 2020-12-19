<?php


namespace Blog\Security;


use Blog\Core\Configuration;

class Firewall
{
    /**
     * Check role
     *
     * @param $url
     * @return bool
     * @throws \Exception
     */
    public static function check($url)
    {
        // https://github.com/adbario/php-dot-notation
        $access = Configuration::read('security.access');

        foreach ($access as $pattern => $role) {
            if(preg_match('#^'.$pattern.'#', $url) && Session::read('role') !== $role) {
                throw new \Exception('Unauthorized', 401);
            }
        }
        return true;
    }
}