<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit65a8882e640840f82a5b23de49691603
{
    public static $files = array (
        '5e187b582b2b3bb26276f0085ef51bb1' => __DIR__ . '/..' . '/leblanc-simon/parsedown-checkbox/ParsedownCheckbox.php',
    );

    public static $prefixLengthsPsr4 = array (
        'J' => 
        array (
            'JoyPixels\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'JoyPixels\\' => 
        array (
            0 => __DIR__ . '/..' . '/joypixels/emoji-toolkit/lib/php/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'ParsedownExtra' => 
            array (
                0 => __DIR__ . '/..' . '/erusev/parsedown-extra',
            ),
            'Parsedown' => 
            array (
                0 => __DIR__ . '/..' . '/erusev/parsedown',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit65a8882e640840f82a5b23de49691603::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit65a8882e640840f82a5b23de49691603::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit65a8882e640840f82a5b23de49691603::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit65a8882e640840f82a5b23de49691603::$classMap;

        }, null, ClassLoader::class);
    }
}
