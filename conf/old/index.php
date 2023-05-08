<?php 
// use Conf\Bootstrap;

// new Bootstrap();

// echo "<pre>";
// var_dump($_SERVER['QUERY_STRING']);
// var_dump($_SERVER['REQUEST_URI']);
// var_dump($_SERVER['SCRIPT_NAME']);
// echo "</pre>";

use Services\Container;

// $container = new Container();
// $container->register('Dependency', 'Dependency');
// $dependency = $container->getInstance('Dependency');
// var_dump($dependency);
// var_dump(new Container);

class Dependency
{
    public function doSomething()
    {
        echo 'Doing something!';
    }
}

class ExampleProvider extends Container
{
    private $dependency;

    public function __construct()
    {
        $this->registerDependencies();
    }

    protected function registerDependencies()
    {
        $this->register('Dependency','Dependency');
    }

    protected function doSomething(Dependency &$dependency=null)
    {
        $dependency = $this->getInstance('Dependency')->doSomething();

    }
}

class ExampleClass extends ExampleProvider
{
    private $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    public function doSomething(Dependency &$dependency=null)
    {
        var_dump($dependency);
        // $dependency->doSomething();
        // var_dump($dependency);
        // var_dump($dependency);;
        // $this->register(get_class($dependency), )
        // $dependency->doSomething();
    }
}


$a = new ExampleClass();
echo"<pre>";
var_dump($a->doSomething());
echo"</pre>";

// $a->go();

// $example = new ExampleClass($dependency);
// $example->doSomething();