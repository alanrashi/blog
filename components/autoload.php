<?php 

spl_autoload_register(function($class_name) {
    //list all the class directories in the array
    $array_paths = array(
        '/core/',
        '/models/',
        '/components/',
    );
    
    foreach($array_paths as $path) {
        $path = ROOT . $path . $class_name . '.php';
        if(is_file($path)) {
            return include_once $path;
        }
    }
    
});