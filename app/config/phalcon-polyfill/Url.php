<?php
namespace Phalcon\Mvc;

class Url {
    protected $baseUri = '/';
    
    public function __construct($baseUri = '/') {
        $this->baseUri = $baseUri;
    }
    
    public function get($uri = null) {
        if ($uri === null) {
            return $this->baseUri;
        }
        
        // Remove leading slash from uri if it exists
        if (strpos($uri, '/') === 0) {
            return $this->baseUri . ltrim($uri, '/');
        }
        
        return $this->baseUri . $uri;
    }
    
    public function getBaseUri() {
        return $this->baseUri;
    }
    
    public function setBaseUri($baseUri) {
        $this->baseUri = $baseUri;
        return $this;
    }
}
