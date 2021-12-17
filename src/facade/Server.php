<?php
namespace Flsoar\Swoho\Facade;
use Flsoar\Swoho\Common\Result;
use Flsoar\Swoho\Core\Swoole\HttpServer;

class Server
{
    /**
     * start a http server
     * @author flyman
     * @param string $name
     * @return Result|\Swoole\Http\Server
     */
    public static function http($name = '')
    {
        $server = HttpServer::instance()->build($name);
        if ($server instanceof Result) {
            echo "init error: " . $server->getError()."\n";
        } else {
            return $server;
        }
    }

    /**
     * start a http server and run it
     * @author flyman
     * @param string $name
     * @return bool
     */
    public static function httpStart($name = '')
    {
        $server = HttpServer::instance()->build($name);
        if ($server instanceof Result) {
            echo "init error: " . $server->getError()."\n";
        } else {
            return $server->start();
        }
    }
}