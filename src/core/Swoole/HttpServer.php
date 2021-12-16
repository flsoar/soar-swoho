<?php
/**
 * Created by PhpStorm.
 * @author flyman
 */

namespace Soar\Swoho\Core\Swoole;
use Soar\Swoho\Common\Result;
use Soar\Swoho\Common\Traits\OneKeyInstance;
use Soar\Swoho\Core\Route\RouteDispatch;
use Soar\Swoho\Facade\Context;
use Soar\Swoho\Core\Entity\Http;
use Soar\Swoho\Core\DB\Eloquent;

class HttpServer
{
    use OneKeyInstance;

    /**
     * @author flyman
     * @param string $name
     * @return Result|\Swoole\Http\Server
     */
    public function build($name = '')
    {
        $config = config('server.http');
        if (! $config) {
            return Result::error('missing http config');
        }

        if (! isset($config[$name])) {
            return Result::error("missing {$name} confg");
        }

        $config = $config[$name];

        $server = new \Swoole\Http\Server($config['address'], $config['port']);
        $server->set([
            'worker_num' => $config['address'],
            'backlog' => $config['backlog']
        ]);
        $server->on('Start', function (\Swoole\Http\Server $server) use ($name) {
            echo "server {$name} is runing\n";
        });
        $server->on('Request', function (\Swoole\Http\Request $request, \Swoole\Http\Response $response) {
            Context::register(
                'request', (new Http\RequestContext())->setRequest($request)
            );
            Context::register('response', $response);
            Eloquent::boot();
            RouteDispatch::handle();
        });

        return $server;

    }
}
