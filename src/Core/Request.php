<?php

namespace Uph\Miklaj\Core;

class Request
{
    protected $method;
    protected $path;
    protected $filename;
    protected $post;
    protected $get;
    protected $session;
    protected $router_data;

    public function __construct($method, $path, $post, $get, $session)
    {
        $this->method = $method;
        $this->path = $path;
        $this->filename = preg_replace('/(\?.*)$/', '', $path);
        $this->post = $post;
        $this->get = $get;
        $this->session = $session;
    }

    public function __set($key, $value)
    {
        if ($key == 'router_data' && !isset($this->router_data)) {
            $this->router_data = $value;
        }
    }

    public function __get($field) {
        if(in_array($field, ['method', 'path', 'filename', 'post', 'get', 'session', 'router_data'])) {
            return $this->{$field};
        }
    }
}

