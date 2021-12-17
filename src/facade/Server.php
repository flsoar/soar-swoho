<?php
namespace Swoho\Facade;
use Swoho\Core\Swoole\HttpServer;

class Server
{
    /**
     * @author flyman
     * @param string $name
     * @return \Swoho\Common\Result|\Swoole\Http\Server
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