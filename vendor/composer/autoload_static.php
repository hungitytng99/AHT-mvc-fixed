<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit538db0c917928ba6187c81a8d6538dce
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MVC\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MVC\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit538db0c917928ba6187c81a8d6538dce::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit538db0c917928ba6187c81a8d6538dce::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit538db0c917928ba6187c81a8d6538dce::$classMap;

        }, null, ClassLoader::class);
    }
}
