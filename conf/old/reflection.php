<?php 

class MyClass {
    public function myMethod(Example $request, Khe $otherDep) {
        $request->go();
        // $otherDep->khejeso();
    }
}   

$reflectionMethod = new ReflectionMethod('MyClass', 'myMethod');
$arguments = [];
foreach ($reflectionMethod->getParameters() as $key => $parameter) {
    if ($parameter->getType()) {
        $class = $parameter->getType()->getName();
        $arguments[] = new $class();
        // $reflectionParam = new ReflectionParameter($arguments[$key]->$methodName,$parameter->getName());
        // $reflectionObj = new ReflectionObject($arguments[$key]);
        // // // var_dump($reflectionObj->getMethods());
        // foreach ($reflectionObj->getMethods() as $keyM => $method) {
        //     $methodName = $method->getName();
        //     $reflectionParam = new ReflectionParameter($arguments[$key]->$methodName,$parameter->getName());
        // }
    }
}
// var_dump($reflectionMethod->getClosureUsedVariables());

// foreach ($arguments as $arg) {
//     $arg->myMethod();
// }

$instance = new MyClass();
// $instance->myMethod();
// foreach ($arguments as $arg) {
$reflectionMethod->invoke($instance, ...$arguments);
// }
