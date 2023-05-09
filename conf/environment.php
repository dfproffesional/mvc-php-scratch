<?php 

const ENV_FILE = __DIR__."/.env";

/**
 * @return void
 */
function readEnv(){
    if (!file_exists(ENV_FILE)){
        throw new Exception('.env File not found');
    }

    $readLines = file(ENV_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    foreach($readLines as $line){
        putenv($line);
    }
}

/**
 * @return void
 */
function defineGlobal(){
    define("__ROOT_DIR__",getenv("ROOT_DIR"));
    define("__SRC_DIR__",__ROOT_DIR__."/src");
    define("__SERVICES_DIR__",__ROOT_DIR__."/services");
    define("__LIB_DIR__",__ROOT_DIR__."/lib");
    define("__CONF_DIR__",__ROOT_DIR__."/conf");
    define("__ROUTES_DIR__",__ROOT_DIR__."/routes");
}

readEnv();
defineGlobal();
