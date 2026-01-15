<?php
namespace Phalcon\Mvc\View\Engine;

class Volt {
    protected $view;
    protected $di;
    protected $options = [];
    
    public function __construct($view, $di = null) {
        $this->view = $view;
        $this->di = $di;
    }
    
    public function setOptions(array $options) {
        $this->options = $options;
        return $this;
    }
    
    public function getOptions() {
        return $this->options;
    }
    
    public function render($path, $params = null, $mustClean = null) {
        // Polyfill: just render as PHP for now
        if (is_array($params)) {
            extract($params);
        }
        
        ob_start();
        include $path;
        return ob_get_clean();
    }
}
