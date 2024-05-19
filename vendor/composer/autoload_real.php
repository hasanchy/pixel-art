<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit316c86f4656ed8ed8e4c9b32046e5807
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit316c86f4656ed8ed8e4c9b32046e5807', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit316c86f4656ed8ed8e4c9b32046e5807', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit316c86f4656ed8ed8e4c9b32046e5807::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
