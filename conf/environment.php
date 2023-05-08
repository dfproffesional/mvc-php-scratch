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

function defineGlobal(){
    define("__ROOT_DIR__",getenv("ROOT_DIR"));
}

readEnv();
defineGlobal();
