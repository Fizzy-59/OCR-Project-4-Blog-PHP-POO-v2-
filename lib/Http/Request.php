<?php


namespace Blog\Http;


class Request
{
    private $request;
    private $query;
    private $server;

    public function __construct()
    {
        $this->request = $_POST;
        $this->query = $_GET;
        $this->server = $_SERVER;
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