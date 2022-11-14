<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6048ff374259d666a1b349f1e1878a21
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
            'AppTest\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'AppTest\\' => 
        array (
            0 => __DIR__ . '/../..' . '/tests',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6048ff374259d666a1b349f1e1878a21::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6048ff374259d666a1b349f1e1878a21::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6048ff374259d666a1b349f1e1878a21::$classMap;

        }, null, ClassLoader::class);
    }
}
