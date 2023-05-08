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
            Environment::class,
            ErrorHandler::class,
        ];
    }

    /**
     * @return void
     */
    public function defaultConfig(){
        $this->makeDI(Environment::class, 'readFile');
        $this->makeDI(ErrorHandler::class, 'displayErrors');
    }
}