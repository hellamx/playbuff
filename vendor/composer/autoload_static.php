<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit966527f161bb3fdf237b105ad787909a
{
    public static $prefixLengthsPsr4 = array (
        'p' => 
        array (
            'playbuff\\' => 9,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
        'V' => 
        array (
            'Valitron\\' => 9,
        ),
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'playbuff\\' => 
        array (
            0 => __DIR__ . '/..' . '/playbuff/core',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'Valitron\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/valitron/src/Valitron',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit966527f161bb3fdf237b105ad787909a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit966527f161bb3fdf237b105ad787909a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit966527f161bb3fdf237b105ad787909a::$classMap;

        }, null, ClassLoader::class);
    }
}