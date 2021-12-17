<?php
namespace Swoho\Core\Route;
use Swoho\Common\Result;
use Swoho\Facade\Context;

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
        $uri .= " ".strtolower(Context::get('request')->requestUri);
        $act = route($uri);
        if (! $act) {
            Result::error('api not exists', 0, [])->send();
        } else {
            $act::instance()->run();
        }
    }
}