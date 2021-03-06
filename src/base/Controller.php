<?php
namespace Flsoar\Swoho\Base;
use Flsoar\Swoho\Common\Result;
use Flsoar\Swoho\Common\Traits\OneKeyInstance;
use Flsoar\Swoho\Facade\Context;

abstract class Controller
{
    use OneKeyInstance;

    /**
     * @author flyman
     * @return mixed
     */
    abstract function run();

    /**
     * success response with json
     * @author flyman
     * @param $data
     */
    public function success($data)
    {
        Result::success($data)->send();
    }

    /**
     * error reponse with json
     * @author flyman
     * @param string $msg
     * @param array $data
     */
    public function error($msg = '', $data = [])
    {
        Result::error($msg, 0, $data)->send();
    }

    /**
     * @author flyman
     * @return mixed
     */
    public function input()
    {
        return Context::get('request')->input();
    }

    /**
     * output html
     * @author flyman
     * @param string $page
     */
    public function html($page = '')
    {
        $response = Context::get('response');
        $response->header('Content-Type', 'text/html');
        $response->sendfile(pagePath($page));
    }
}