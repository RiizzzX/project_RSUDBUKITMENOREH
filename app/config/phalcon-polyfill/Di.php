<?php
namespace Phalcon\Di;

class FactoryDefault {
    protected $services = [];
    protected $shared = [];
    
    public function __construct() {
        // Auto-register basic services
        $this->setShared('router', function() {
            return new \Phalcon\Mvc\Router();
        });
    }
    
    public function set($name, $definition, $shared = false) {
        $this->services[$name] = $definition;
        if ($shared) {
            $this->shared[$name] = true;
        }
    }
    
    public function setShared($name, $definition) {
        $this->set($name, $definition, true);
    }
    
    public function get($name) {
        if (!isset($this->services[$name])) {
            throw new \Exception("Service '{$name}' not found");
        }
        
        $definition = $this->services[$name];
        
        // If callable (Closure or function), resolve it
        if ($definition instanceof \Closure) {
            // Bind closure to DI instance for $this context
            $definition = $definition->bindTo($this);
            $instance = call_user_func($definition);
            if (isset($this->shared[$name])) {
                $this->services[$name] = $instance;
            }
            return $instance;
        }
        
        if (is_callable($definition) && !is_object($definition)) {
            $instance = call_user_func($definition);
            if (isset($this->shared[$name])) {
                $this->services[$name] = $instance;
            }
            return $instance;
        }
        
        // Return object or definition as-is
        return $definition;
    }
    
    public function has($name) {
        return isset($this->services[$name]);
    }
    
    public function getConfig() {
        return $this->get('config');
    }
    
    public function getShared($name) {
        return $this->get($name);
    }
    
    public function getRouter() {
        return $this->get('router');
    }
}
