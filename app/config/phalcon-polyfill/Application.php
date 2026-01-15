<?php
namespace Phalcon\Mvc;

class Application {
    protected $di;
    
    public function __construct($di) {
        $this->di = $di;
    }
    
    public function handle($uri = null) {
        $router = $this->di->getRouter();
        $router->handle($uri ?? $_SERVER['REQUEST_URI']);
        
        $controllerName = ucfirst($router->getControllerName()) . 'Controller';
        $actionName = $router->getActionName() . 'Action';
        
        // Build controller class name
        $controllerClass = $controllerName;
        
        // Try to load controller
        $controllerFile = dirname(__DIR__, 3) . '/controllers/' . $controllerClass . '.php';
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
        }
        
        $content = '';
        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            $controller->di = $this->di;
            
            // Setup view if available
            if ($this->di->has('view')) {
                $controller->view = $this->di->get('view');
                
                // Setup view helpers - pass DI services as view properties
                if ($this->di->has('url')) {
                    $controller->view->url = $this->di->get('url');
                }
            }
            
            if (method_exists($controller, $actionName)) {
                // Execute action
                $controller->$actionName();
                
                // Render view if available
                if (isset($controller->view) && $controller->view instanceof View) {
                    $content = $controller->view->render(
                        $router->getControllerName(),
                        $router->getActionName()
                    );
                } else {
                    $content = '';
                }
            } else {
                $content = "Action '{$actionName}' not found in controller '{$controllerClass}'";
            }
        } else {
            $content = "Controller '{$controllerClass}' not found";
        }
        
        // Return response object
        return new class($content) {
            protected $content;
            
            public function __construct($content) {
                $this->content = $content;
            }
            
            public function setContent($content) {
                $this->content = $content;
                return $this;
            }
            
            public function getContent() {
                return $this->content;
            }
        };
    }
}
