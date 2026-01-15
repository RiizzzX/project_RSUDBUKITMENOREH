<?php
namespace Phalcon\Autoload;

class Loader {
    protected $namespaces = [];
    protected $directories = [];
    
    public function registerNamespaces(array $namespaces, $merge = false) {
        if ($merge) {
            $this->namespaces = array_merge($this->namespaces, $namespaces);
        } else {
            $this->namespaces = $namespaces;
        }
        return $this;
    }
    
    public function registerDirs(array $directories, $merge = false) {
        if ($merge) {
            $this->directories = array_merge($this->directories, $directories);
        } else {
            $this->directories = $directories;
        }
        return $this;
    }
    
    public function setDirectories(array $directories) {
        $this->directories = $directories;
        return $this;
    }
    
    public function register() {
        spl_autoload_register(function($className) {
            // Try namespaces
            foreach ($this->namespaces as $namespace => $path) {
                if (strpos($className, $namespace) === 0) {
                    $relativeClass = substr($className, strlen($namespace));
                    $file = $path . str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';
                    if (file_exists($file)) {
                        require_once $file;
                        return true;
                    }
                }
            }
            
            // Try directories
            foreach ($this->directories as $directory) {
                $file = $directory . DIRECTORY_SEPARATOR . $className . '.php';
                if (file_exists($file)) {
                    require_once $file;
                    return true;
                }
            }
            
            return false;
        });
        return $this;
    }
}
