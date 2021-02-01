<?php


namespace Blog\Http;


use Blog\Security\Session;

class Request
{
    private $request;
    private $query;
    private $server;
    private $session;

    public function __construct()
    {
        $this->request = $_POST;
        $this->query  = $_GET;
        $this->server = $_SERVER;
        $this->session  = new Session();
    }

    public function session() {
        return $this->session;
    }

    /**
     * @param $key
     */
    public function query($key)
    {
        return $this->query[$key];
    }

    /**
     * @param $key
     */
    public function request($key)
    {
        return $this->request[$key];
    }

    /**
     * Access Admin
     *
     * @param $method
     * @return bool
     */
    public function isMethod($method)
    {
        return $this->server['REQUEST_METHOD'] === strtoupper($method);
    }

    public function server($key)
    {
        return $this->server[$key];
    }
}