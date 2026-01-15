<?php
namespace Phalcon\Mvc\View\Engine;

class Php {
    protected $view;
    protected $di;
    
    public function __construct($view, $di = null) {
        $this->view = $view;
        $this->di = $di;
    }
    
    public function render($path, $params = null, $mustClean = null) {
        if (is_array($params)) {
            extract($params);
        }
        
        ob_start();
        include $path;
        return ob_get_clean();
    }
}
