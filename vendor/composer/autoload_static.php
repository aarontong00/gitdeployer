<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit918aa8d8350401aeefc982828831f7de
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Workerman\\' => 10,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Workerman\\' => 
        array (
            0 => __DIR__ . '/..' . '/workerman/workerman',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit918aa8d8350401aeefc982828831f7de::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit918aa8d8350401aeefc982828831f7de::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
