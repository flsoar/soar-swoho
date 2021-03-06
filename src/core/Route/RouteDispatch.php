<?php
namespace Flsoar\Swoho\Core\Route;
use Flsoar\Swoho\Common\Result;
use Flsoar\Swoho\Facade\Context;

class RouteDispatch
{

    /**
     * route dispatch
     * @author flyman
     * @return bool|mixed
     */
    public static function handle()
    {
        $uri = Context::get('request')->method();
        $uri .= " ".Context::get('request')->requestUri;
        $act = route($uri);
        if (! $act) {
            Result::error('api not exists', 0, [])->send();
        } else {
            (new $act())->run();
        }
    }
}