<?php 

namespace Src\Controllers;

use Lib\Debugger;
use Lib\HttpRequest;

class ExampleController
{
    public function index(HttpRequest $serv)
    {
        Debugger::dump($serv->getParams(),$serv->getQuery());
    }
}