<?php
namespace Soar\Swoho\Facade;
use Soar\Swoho\Core\Swoole\HttpServer;

class Server
{
    /**
     * careate http server
     * @author flyman
     * @param string $name
     * @return \Soar\Swoho\Common\Result|\Swoole\Http\Server
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