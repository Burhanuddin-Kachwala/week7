<?php

namespace core;
use Exception;

class Container
{
    protected $bindings = [];

    public function bind($key, $resolver)
    {
        $this->bindings[$key] = $resolver;
    }
    

    public function resolve($key)
    {
        // dd($this->bindings);
        if (isset($this->bindings[$key])) {
            $resolver = $this->bindings[$key];
            return call_user_func($resolver);
        }

      
        throw new Exception("No binding found for key: {$key}");
        
    }
}
?>