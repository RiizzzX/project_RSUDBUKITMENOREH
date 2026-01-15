<?php
namespace Phalcon\Mvc;

class Controller {
    public $view;
    public $response;
    public $di;
    
    public function __construct() {
        $this->view = new \stdClass();
        $this->response = new \stdClass();
    }
    
    public function __set($name, $value) {
        $this->$name = $value;
    }
    
    public function __get($name) {
        return $this->$name ?? null;
    }
}
