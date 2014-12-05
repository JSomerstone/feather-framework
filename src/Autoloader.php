<?php
namespace JSomerstone\Feather;

class Autoloader
{
    /**
    * Registers JSomerstone\Feather\Autoloader as an SPL autoloader.
    *
    */
    public static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'), true, false);
    }

    /**
    * Handles autoloading of classes.
    *
    * @param string $class A class name.
    */
    public static function autoload($class)
    {
        if (0 !== strpos($class, 'JSomerstone\Feather'))
        {
            return;
        }
        $class = str_replace('JSomerstone\Feather\\', '', $class);
        $filePath = __DIR__ .'/'.str_replace('\\', "/", $class).'.php';
        if (is_file($filePath))
        {
            require $filePath;
        }
    }
}
