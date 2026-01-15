<?php
namespace Phalcon\Config;

class Config implements \ArrayAccess {
    protected $data = [];
    
    public function __construct($arrayConfig = null) {
        if (is_array($arrayConfig)) {
            foreach ($arrayConfig as $key => $value) {
                if (is_array($value)) {
                    $this->data[$key] = new static($value);
                } else {
                    $this->data[$key] = $value;
                }
            }
        }
    }
    
    public function get($index, $defaultValue = null) {
        return $this->data[$index] ?? $defaultValue;
    }
    
    public function __get($index) {
        return $this->data[$index] ?? null;
    }
    
    public function __set($index, $value) {
        $this->data[$index] = $value;
    }
    
    public function __isset($index) {
        return isset($this->data[$index]);
    }
    
    public function offsetExists($offset): bool {
        return isset($this->data[$offset]);
    }
    
    public function offsetGet($offset): mixed {
        return $this->data[$offset] ?? null;
    }
    
    public function offsetSet($offset, $value): void {
        $this->data[$offset] = $value;
    }
    
    public function offsetUnset($offset): void {
        unset($this->data[$offset]);
    }
    
    public function toArray() {
        $array = [];
        foreach ($this->data as $key => $value) {
            if ($value instanceof Config) {
                $array[$key] = $value->toArray();
            } else {
                $array[$key] = $value;
            }
        }
        return $array;
    }
}
