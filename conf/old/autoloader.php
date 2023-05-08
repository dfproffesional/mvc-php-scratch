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

    // // project-specific namespace prefix
    // $prefix = 'App\\';

    // // does the class use the namespace prefix?
    // $len = strlen($prefix);
    
    // // validate if prefix is defined in the class exist
    // // with the $len get the characters and compare the diference
    // $validateClass = strncmp($prefix, $class, $len) !== 0;

    // if ($validateClass) {
    //     // no, move to the next registered autoloader
    //     return;
    // }

    // // get the relative class name
    // $relative_class = substr($class, $len);

    // get folder if exist
    $folder = explode('\\',$class)[0];
    if (!isset($folder)){
        return;
    }
    // var_dump($folder);

    // base directory for the namespace prefix
    $base_dir = __DIR__;
    // var_dump($base_dir);
    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace("$folder\\", '/', $class) . '.php';
    // $file = str_replace('/app/','',$file);
    
    // var_dump($file);
    
    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});