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
     * @param string $method
     * @return void
     */
    private function setMethodUri($method){
        Router::$methodUri = $method;
    }

    /**
     * @param string $uri
     * @return void
     */
    private function setUri($uri){
        Router::$uri = $uri;
    }

    /**
     * @param string $filename
     * @return void
     */
    private function importRoutes($filename){
        require_once(__ROUTES_DIR__."/$filename");
    }

    /**
     * @return void
     */
     public function boot(HttpRequest $serv){
        $this->setMethodUri($serv->getMethod());
        $this->setUri($serv->getUri());
        $this->importRoutes("api.php");
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
