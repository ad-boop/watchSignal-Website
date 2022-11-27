<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit43d922bc7fac7b931c877e9038ea34da
{
    public static $files = array (
        '3a37ebac017bc098e9a86b35401e7a68' => __DIR__ . '/..' . '/mongodb/mongodb/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MongoDB\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MongoDB\\' => 
        array (
            0 => __DIR__ . '/..' . '/mongodb/mongodb/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit43d922bc7fac7b931c877e9038ea34da::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit43d922bc7fac7b931c877e9038ea34da::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit43d922bc7fac7b931c877e9038ea34da::$classMap;

        }, null, ClassLoader::class);
    }
}