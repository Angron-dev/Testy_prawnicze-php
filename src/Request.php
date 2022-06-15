<?php 

declare(strict_types=1);

namespace App;

class Request 
{   
    private array $post = [];
    private array $get = [];
    private array $server =[];
    
    public function __construct(array $get, array $post, array $server)
    {
        $this->get = $get;
        $this->post = $post;
        $this->server = $server;
    }

    public function isPost(): bool
    {
        return $this->server['REQUEST_METHOD'] == "POST";
    }
    public function isGet(): bool
    {
        return $this->server['REQUEST_METHOD'] == "GET";
    }
    public function getParams(string $name, $default = null)
    {
        return $this->get[$name] ?? $default;
    }
    public function postParams($default = null)
    {
        return $this->post ?? $default;
    }
    public function hasPosts():bool
    {
        return !empty($this->post);
    }
}
