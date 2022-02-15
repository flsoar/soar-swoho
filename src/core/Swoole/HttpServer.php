<?php
/**
 * Created by PhpStorm.
 * @author flyman
 */

namespace Flsoar\Swoho\Core\Swoole;
use Flsoar\Swoho\Common\Result;
use Flsoar\Swoho\Common\Traits\OneKeyInstance;
use Flsoar\Swoho\Core\Route\RouteDispatch;
use Flsoar\Swoho\Core\Route\RouteValidate;
use Flsoar\Swoho\Facade\Context;
use Flsoar\Swoho\Core\Entity\Http;
use Flsoar\Swoho\Core\DB\Eloquent;
use Swoole\Coroutine as Co;
use Swoole\Process\Pool;
use Swoole\Redis;

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
        if (! defined('APP')) {
            return Result::error('the entry file does not define APP constants');
        }

        $config = config('server.http');
        if (! $config) {
            return Result::error('missing http server config');
        }

        if (! isset($config[$name])) {
            return Result::error("missing {$name} confg");
        }

        $config = $config[$name];
        $server = new \Swoole\Http\Server($config['address'], $config['port']);
        $server->set([
            #'daemonize'  => 2,
            'worker_num'        => $config['worker_num'] ?? '',
            'backlog'           => $config['backlog'] ?? '',
            'enable_coroutine'  => true,
            'send_yield'        => true,
            'enable_reuse_port' => true
        ]);
        $server->on('Start', function (\Swoole\Http\Server $server) use ($name) {
            console('http server build', "server {$name} is runing");
        });
        $server->on('WorkerStart', function (\Swoole\Http\Server $server, $workerId) {
            echo "Worker#{$workerId} is started\n";
        });

        $server->on('Request', function (\Swoole\Http\Request $request, \Swoole\Http\Response $response) {
            Context::register(
                'request', (new Http\RequestContext())->setRequest($request)
            );
            Context::register('response', $response);
            Eloquent::boot();
            $validateRet = RouteValidate::handle();
            if ($validateRet instanceof Result) {
                $validateRet->send();
            } else {
                RouteDispatch::handle();
            }

        });

        return $server;

    }
}
