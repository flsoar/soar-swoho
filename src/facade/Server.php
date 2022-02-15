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
        try {
            $server = HttpServer::instance()->build($name);
            if ($server instanceof Result) {
                console('server http', $server->getError());
            } else {
                return $server;
            }
        } catch (\Exception $e) {
            console('server http exception', $e->getMessage());
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
        try {
            $server = HttpServer::instance()->build($name);
            if ($server instanceof Result) {
                console('server http start', $server->getError());
            } else {
                Context::register('server', $server);
                return $server->start();
            }
        } catch (\Exception $e) {
            console('server http start exception', $e->getMessage().' in file '.$e->getFile().' on line '.$e->getLine());
        }

    }
}