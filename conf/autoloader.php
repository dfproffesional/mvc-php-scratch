<?php
/**
 * An example of a project-specific implementation.
 *
 * After registering this autoload function with SPL, the following line
 * would cause the function to attempt to load the \Foo\Bar\Baz\Qux class
 * from /path/to/project/src/Baz/Qux.php:
 *
 *      new \Foo\Bar\Baz\Qux;
 *
 * @param string $class The fully-qualified class name.
 * @return void
 */
spl_autoload_register(function ($class) {

    // get prefix
    $prefix = isset(explode('\\',$class)[0]) 
        ? explode('\\',$class)[0] 
        : $class;
    
    // document root
    $documentRoot = "/app";
    
    // edit prefix
    $documentRoot = "$documentRoot/".strtolower($prefix);
    
    // validate if custom $prefix can be match with a directory
    $validate = preg_match(strtolower("/$prefix/"), $documentRoot) !== 1;
    
    // if exist 
    if ($validate){
        return;
    }

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file =  $documentRoot . str_replace("$prefix\\", '/', $class) . '.php';
    
    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

