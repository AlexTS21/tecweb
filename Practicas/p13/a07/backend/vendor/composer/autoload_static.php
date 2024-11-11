<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitef9465f120583511e69100480cb3f5eb
{
    public static $prefixLengthsPsr4 = array (
        'm' => 
        array (
            'myAPI\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'myAPI\\' => 
        array (
            0 => __DIR__ . '/../..' . '/myAPI',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'myAPI\\Create\\Create' => __DIR__ . '/../..' . '/myAPI/Create/Create.php',
        'myAPI\\DataBase\\DataBase' => __DIR__ . '/../..' . '/myAPI/DataBase/DataBase.php',
        'myAPI\\Delete\\Delete' => __DIR__ . '/../..' . '/myAPI/Delete/Delete.php',
        'myAPI\\Read\\Read' => __DIR__ . '/../..' . '/myAPI/Read/Read.php',
        'myAPI\\Update\\Update' => __DIR__ . '/../..' . '/myAPI/Update/Update.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitef9465f120583511e69100480cb3f5eb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitef9465f120583511e69100480cb3f5eb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitef9465f120583511e69100480cb3f5eb::$classMap;

        }, null, ClassLoader::class);
    }
}
