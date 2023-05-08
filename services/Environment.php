<?php 

namespace Services;

use Exception;

class Environment
{
    const ENV_FILE = __DIR__."/../conf/.env";

    /**
     * @return void
     */
    public function readFile(){
        if (!file_exists(self::ENV_FILE)){
            throw new Exception('.env File not found');
        }

        $readLines = file(self::ENV_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        foreach($readLines as $line){
            putenv($line);
        }
    }

}