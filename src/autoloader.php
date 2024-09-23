<?php

class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $classPath = __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
            if (file_exists($classPath)) {
                require $classPath;
            }
        });
    }
}

