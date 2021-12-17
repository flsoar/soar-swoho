<?php
namespace Flsoar\Swoho\Facade;
use Flsoar\Swoho\Core\Swoole\HttpServer;

class Server
{
    /**
     * @author flyman
     * @param string $name
     * @return \Flsoar\Swoho\Common\Result|\Swoole\Http\Server
     */
    public static function http($name = '')
    {
        return HttpServer::instance()->build($name);
    }

    /**
     * create http server and start it
     * @author flyman
     * @param string $name
     * @return bool
     */
    public static function httpStart($name = '')
    {
        return HttpServer::instance()->build($name)->start();
    }
}