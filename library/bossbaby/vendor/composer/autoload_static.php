<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit260c8aa5acc5cc8e637c9dd0991124cd
{
	public static $files = array (
        // 
    );

    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'BossBaby\\' => 3,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'BossBaby\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit260c8aa5acc5cc8e637c9dd0991124cd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit260c8aa5acc5cc8e637c9dd0991124cd::$prefixDirsPsr4;
        }, null, ClassLoader::class);
    }
}
