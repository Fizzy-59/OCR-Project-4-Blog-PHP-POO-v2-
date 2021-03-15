<?php


namespace Blog\Security;


use Exception;

class Session
{

    private $_session;

    public function __construct() {
        session_start();
        $this->_session = $_SESSION;
    }

    public function read($key)
    {
        return $this->_session[$key];
    }

    public function write($key, $value)
    {
        $this->_session[$key] = $value;
        $_SESSION[$key] = $value;
    }

    public function get() {
        return $this->_session;
    }

    public function destroy()
    {
        session_destroy();
    }
}