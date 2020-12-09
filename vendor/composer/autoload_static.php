<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0b52858b614f14ba4ba4a976bbf40e78
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0b52858b614f14ba4ba4a976bbf40e78::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0b52858b614f14ba4ba4a976bbf40e78::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}