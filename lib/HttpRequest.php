<?php

namespace Lib;

use Services\Router;

class HttpRequest
{
    private $cookies;
    private $serv;
    private $req;

    public static $prefix;

    public function __construct()
    {
        $this->cookies = $_COOKIE;
        $this->serv = $_SERVER;
        $this->req = $_REQUEST;
    }

    /**
     * @return string
     */
    public function getUri(){
        return substr($this->serv['REQUEST_URI'],1);
    }

    /**
     * @return string
     */
    public function getMethod(){
        return $this->serv['REQUEST_METHOD'];
    }

    /**
     * @return void
     */
    public static function setPrefix($prefix){
        Router::$prefix = $prefix;
    }

    /**
     * @return array
     */
    public function getParams(){
        $getUri = explode("?",$this->getUri())[0];
        $getPartsUri = explode("/",$getUri);
        $getPartsPrefix = explode("/",Router::$prefix);
        $getPrefixNumber = count($getPartsPrefix);
        return array_splice($getPartsUri, $getPrefixNumber);
    }

    /**
     * @return array
     */
    public function getQuery(){
        return $this->req;
    }
}