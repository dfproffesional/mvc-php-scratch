<?php

namespace Services;

class App extends Container
{

    public function __construct()
    {
        $this->setDeps();
        $this->setMultipleMethods();
        $this->defaultConfig();
    }

    /**
     * @return void
     */
    private function setDeps()
    {
        $this->deps = [
            Router::class,
            ErrorHandler::class,
        ];
    }

    /**
     * @return void
     */
    public function defaultConfig(){
        $this->makeDI(ErrorHandler::class, 'displayErrors');
        $this->makeDI(Router::class,'getPartsUri');
    }
}