<?php 

namespace Lib;

class Debugger
{
    static function dump($data,...$args){
        echo "<pre style='background:#e6f9ff;margin:16px;border:1px solid #4dd2ff;padding:16px;border-radius:8px;'>";
        var_dump($data, $args);
        echo "</pre>";
    }
}
