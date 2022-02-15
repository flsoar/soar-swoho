<?php

/**
 * load route config
 */
if (! function_exists('route')) {
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
        if (strpos($str, '.')) {
            list($file, $key) = explode('.', $str);
        } else {
            $file = $str;
        }

        if (! file_exists(APP . "/config/{$file}.php")) {
            return false;
        }

        $config = require APP . "/config/{$file}.php";
        if (! isset($key)) {
            return $config;
        }

        return $config[$key] ?? [];
    }
}


/**
 * load config
 */
if (! function_exists('pagePath')) {
    function pagePath($str = '')
    {
        if (! file_exists(APP . "/pages/{$str}.php")) {
            return false;
        }

        return APP . "/pages/{$str}.php";
    }
}


if (! function_exists('console')) {
    function console($node = '', $msg = '') {
        echo "{$node}: {$msg}\r\n";
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