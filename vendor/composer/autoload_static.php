<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit43149dff792dd2d36e4b336bdd6c6b25
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'B' => 
        array (
            'BookWorms\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'BookWorms\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes/BookWorms',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit43149dff792dd2d36e4b336bdd6c6b25::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit43149dff792dd2d36e4b336bdd6c6b25::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit43149dff792dd2d36e4b336bdd6c6b25::$classMap;

        }, null, ClassLoader::class);
    }
}