<?php
namespace Phalcon\Mvc;

class Router {
    protected $routes = [];
    protected $controller = 'index';
    protected $action = 'index';
    
    public function add($pattern, $paths = null) {
        $this->routes[] = [
            'pattern' => $pattern,
            'paths' => $paths
        ];
        return $this;
    }
    
    public function handle($uri) {
        // Simple routing logic
        $uri = rtrim($uri, '/');
        $parts = explode('/', trim($uri, '/'));
        
        if (!empty($parts[0])) {
            $this->controller = $parts[0];
        }
        if (!empty($parts[1])) {
            $this->action = $parts[1];
        }
    }
    
    public function getControllerName() {
        return $this->controller;
    }
    
    public function getActionName() {
        return $this->action;
    }
}
