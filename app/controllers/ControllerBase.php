<?php
declare(strict_types=1);

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    // Implement common logic
    
    protected function getControllerName() {
        $class = get_class($this);
        $class = str_replace('Controller', '', $class);
        return strtolower($class);
    }
}
