<?php 

declare(strict_types=1);

namespace App;

class Request 
{   
    private array $post = [];
    private array $get = [];
    
    public function __construct(array $get, array $post)
    {
        $this->get = $get;
        $this->post = $post;
    }
        public function getRequestGet(): array
    {
        return $this->request['get'] ?? [];
    }

    public function getRequestPost(): array
    {
        return $this->request['post'] ?? [];
    }
}
