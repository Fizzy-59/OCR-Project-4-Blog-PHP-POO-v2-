<?php


namespace Blog\Security;


use Exception;

class Session
{

    private static $_session;


    /**
     * Initialize Session
     */
    public static function init()
    {
        session_start();
        self::$_session = $_SESSION;
    }

    public static function read($key)
    {
        return self::$_session[$key];
    }

    public static function write($key, $value)
    {
        self::$_session[$key] = $value;
    }
}