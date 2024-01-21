<?php 

spl_autoload_register('autoloader');

function autoloader($class){
    $directory  = 'Class/';
    $ext        = '.php';

    $fullPath = $directory.$class.$ext;

    if (!file_exists($fullPath)) {
        echo "Can't find $fullPath file";
    }else{
        require_once $fullPath;
    }
}