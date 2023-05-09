<?php 

namespace Services;

use Exception;
use Lib\Debugger;
use Lib\HttpRequest;

class Router extends Container
{
    const CONTROLLER_DIR = __SRC_DIR__."/controllers";
    const NAME_SPACE = "Src\Controllers";
    
    public static $methodUri;
    public static $uri;
    public static $prefix;

    /**
     * @return void
     */
    public function setStaticData(HttpRequest $serv){
        Router::$methodUri = $serv->getMethod();
        Router::$uri = $serv->getUri();
    }

    /**
     * @return void
     */
    public static function get($prefix,$class,$method){
        if (!preg_match("#$prefix#", Router::$uri)){
            throw new Exception("Not found");
        }
        
        HttpRequest::setPrefix($prefix);
        Router::appendMakeDI($class,$method);
    }

    /**
     * @return void
     */
    public static function appendMakeDI($class,$method){
        Router::appendDependence($class);
        Router::makeDI($class,$method);
    }
}
