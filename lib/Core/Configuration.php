<?php


namespace Blog\Core;


use Exception;
use Adbar\Dot;

class Configuration
{
    static private $_vars = [];

    public static function config()
    {
        // TODO : Need To Complete
        self::$_vars['security'] = require(ROOT_DIR.'/config/security.php');
        self::$_vars = new Dot(self::$_vars);

    }

    /**
     * Add Var for Configuration
     *
     * @param $key
     * @return mixed
     * @throws Exception
     */
    public static function read($key)
    {
        if(!self::$_vars[$key]) throw new Exception('Core key `'.$key.'` not found');

        return self::$_vars[$key];
    }

    /**
     * Read Var Configuration
     *
     * @param $key
     * @param $value
     */
    public static function write($key, $value)
    {
        self::$_vars[$key] = $value;
    }

}