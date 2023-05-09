<?php

namespace Services;

use ReflectionMethod;
use ReflectionObject;

/**
 * @property Array<ReflectionMethod[]> $methods
 */
class Container
{
    protected static $deps = [];

    protected static $methods;

    /**
     * @return void
     */
    protected static function setMultipleMethods()
    {
        foreach (Container::$deps as $class) {
            $getInstance = new $class();
            $reflectionObject = new ReflectionObject($getInstance);
            
            Container::$methods[$class] = $reflectionObject->getMethods();
        }
    }

    /**
     * @param class $class
     * @return void
     */
    protected static function appendDependence($class){
        array_push(Container::$deps, $class);
        Container::$methods[$class] = (new ReflectionObject(new $class()))->getMethods();
    }

    /**
     * @param class $class
     * @param function string
     * @return void
     */
    protected static function makeDI($class,$function)
    {
        $method = array_filter(
            Container::$methods[$class], 
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
    protected static function makeAutomaticDI()
    {
        foreach (Container::$methods as $class => $methods) {
            foreach ($methods as $method) {
                $args = array_map(fn($param) => new ($param->getType()->getName())(),$method->getParameters());
                $method->invoke(new $class(), ...$args);
            }
        }
        Container::makeDI(Example::class,'go');
    }
}
