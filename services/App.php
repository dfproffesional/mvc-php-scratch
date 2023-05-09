<?php

namespace Services;

class App extends Container
{

    public function __construct()
    {
        App::setDeps();
        App::setMultipleMethods();
        App::defaultConfig();
    }

    /**
     * @return void
     */
    private static function setDeps()
    {
        App::$deps = [
            Router::class,
            ErrorHandler::class,
        ];
    }

    /**
     * @return void
     */
    private static function defaultConfig(){
        App::makeDI(ErrorHandler::class, 'displayErrors');
        App::makeDI(Router::class,'boot');
    }
}