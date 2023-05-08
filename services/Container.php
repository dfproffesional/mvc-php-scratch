<?php

namespace Services;

use ReflectionMethod;
use ReflectionObject;

/**
 * @property Array<ReflectionMethod[]> $methods
 */
class Container
{
    protected $deps = [];

    protected $methods;

    /**
     * @return void
     */
    protected function setMultipleMethods()
    {
        foreach ($this->deps as $class) {
            $getInstance = new $class();
            $reflectionObject = new ReflectionObject($getInstance);
            
            $this->methods[$class] = $reflectionObject->getMethods();
        }
    }

    /**
     * @param class $class
     * @return void
     */
    protected function appendDependence($class){
        array_push($this->deps, $class);
        $this->methods[$class] = (new ReflectionObject(new $class()))->getMethods();
    }

    /**
     * @param class $class
     * @param function string
     * @return void
     */
    protected function makeDI($class,$function)
    {
        $method = array_filter(
            $this->methods[$class], 
            fn($method)=> $method->name == $function 
        );
        $key = array_key_first($method);
        $args = array_map(
            fn($param) => new ($param->getType()->getName())(),
            $method[$key]->getParameters()
        );

        $method[$key]->invoke(new $class(), ...$args);
        
    }

    /**
     * @return void
     */
    protected function makeAutomaticDI()
    {
        foreach ($this->methods as $class => $methods) {
            foreach ($methods as $method) {
                $args = array_map(fn($param) => new ($param->getType()->getName())(),$method->getParameters());
                $method->invoke(new $class(), ...$args);
            }
        }
        $this->makeDI(Example::class,'go');
    }
}
