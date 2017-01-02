<?php 

namespace Barbosa\HackPack\Simulations;

class Router
{
    private $uri = '';

    public function __construct($uri = '')
    {
        $this->uri = $uri;
    }
    
    public function setUri($uri)
    {
        $this->uri = $uri;        
    }
    
    public function getUri()
    {
        return $this->uri;
    }
}