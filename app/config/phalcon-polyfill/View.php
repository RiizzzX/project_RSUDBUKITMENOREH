<?php
namespace Phalcon\Mvc;

class View {
    protected $viewsDir;
    protected $mainView = 'main';
    protected $layoutsDir = 'layouts/';
    protected $partialsDir = '';
    protected $viewVars = [];
    protected $disabled = false;
    protected $di;
    protected $properties = [];
    
    public function __set($name, $value) {
        $this->properties[$name] = $value;
    }
    
    public function __get($name) {
        return $this->properties[$name] ?? null;
    }
    
    public function setDI($di) {
        $this->di = $di;
    }
    
    public function getDI() {
        return $this->di;
    }
    
    public function setViewsDir($viewsDir) {
        $this->viewsDir = $viewsDir;
    }
    
    public function getViewsDir() {
        return $this->viewsDir;
    }
    
    public function setMainView($mainView) {
        $this->mainView = $mainView;
    }
    
    public function setLayoutsDir($dir) {
        $this->layoutsDir = $dir;
    }
    
    public function setPartialsDir($dir) {
        $this->partialsDir = $dir;
    }
    
    public function setVar($key, $value) {
        $this->viewVars[$key] = $value;
    }
    
    public function setVars(array $vars) {
        $this->viewVars = array_merge($this->viewVars, $vars);
    }
    
    public function getVar($key) {
        return $this->viewVars[$key] ?? null;
    }
    
    public function disable() {
        $this->disabled = true;
    }
    
    public function registerEngines($engines) {
        // Polyfill only supports PHP
        return $this;
    }
    
    public function render($controller, $action, $params = null) {
        if ($this->disabled) {
            return '';
        }
        
        // Extract variables
        extract($this->viewVars);
        
        ob_start();
        
        // Render action view
        $actionView = $this->viewsDir . strtolower($controller) . '/' . $action . '.phtml';
        if (file_exists($actionView)) {
            include $actionView;
        }
        
        $viewContent = ob_get_clean();
        
        // Render layout
        if ($this->mainView) {
            ob_start();
            $content = $viewContent; // Make available to layout
            // Pass view object as $this to layout
            $view = $this;
            $layoutFile = $this->viewsDir . $this->layoutsDir . $this->mainView . '.phtml';
            if (file_exists($layoutFile)) {
                include $layoutFile;
            } else {
                echo $viewContent;
            }
            return ob_get_clean();
        }
        
        return $viewContent;
    }
}
