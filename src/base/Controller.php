<?php
namespace Swoho\Base;
use Swoho\Common\Result;
use Swoho\Common\Traits\OneKeyInstance;
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
}