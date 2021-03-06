<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcdb55faf192c4314e8ebf504f991beec
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MamcoSy\\' => 8,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MamcoSy\\' => 
        array (
            0 => __DIR__ . '/../..' . '/MamadouAlySy/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcdb55faf192c4314e8ebf504f991beec::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcdb55faf192c4314e8ebf504f991beec::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcdb55faf192c4314e8ebf504f991beec::$classMap;

        }, null, ClassLoader::class);
    }
}
