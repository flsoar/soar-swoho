<?php

/**
 * load route config
 */
if (! function_exists('config')) {
    function route($key = '')
    {
        $route = require APP . '/config/route.php';
        if ( $key ) {
            if ( !isset($route[$key]) ) {
                return false;
            }
            return $route[$key];
        }
        return $route;

    }
}

/**
 * load config
 */
if (! function_exists('config')) {
    function config($str = '')
    {
        list($file, $key) = explode('.', $str);
        if (! file_exists(APP . "/config/{$file}.php")) {
            return false;
        }

        $config = require APP . "/config/{$file}.php";
        if (empty($key)) {
            return $config;
        }

        return $config[$key] ?? [];
    }
}

/**
 * debug output
 */
if (! function_exists('dd')) {
    function dd(...$vars)
    {
        foreach ($vars as $v) {
            \Symfony\Component\VarDumper\VarDumper::dump($v);
        }

        exit(1);
    }
}