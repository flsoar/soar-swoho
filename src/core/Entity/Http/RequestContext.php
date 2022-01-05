<?php
namespace Flsoar\Swoho\Core\Entity\Http;

use Swoole\Http\Request;

/**
 * Class RequestContext
 * @author flyman
 * @package App\Core\Entity\Http
 */
class RequestContext
{
    /**
     * @var
     */
    public $request;

    /**
     * @var
     */
    public $requestUri;

    /**
     * @var
     */
    public $requestTime;

    /**
     * @var
     */
    protected $server;

    /**
     * set request
     * @author flyman
     * @param Request $request
     * @return $this
     */
    public function setRequest(Request $request)
    {
        $this->request     = $request;
        $this->server      = $request->server;
        $this->requestUri  = $this->server['request_uri'];
        $this->requestTime = $this->server['request_time_float'];
        return $this;
    }

    /**
     * is get request
     * @author flyman
     * @return bool
     */
    public function isGet()
    {
        if ($this->server['request_method'] == 'GET') {
            return true;
        }

        return false;
    }

    /**
     * is post request
     * @author flyman
     * @return bool
     */
    public function isPost()
    {
        if ($this->server['request_method'] == 'POST') {
            return true;
        }

        return false;
    }

    /**
     * request method
     * @author flyman
     * @return string
     */
    public function method()
    {
        return strtoupper($this->server['request_method']);
    }

    /**
     * @author flyman
     * @return array
     */
    public function input()
    {
        if ($this->isGet()) {
            return $this->request->get ?? [];
        }

        else if ($this->isPost()) {
            return $this->request->post ?? [];
        }
    }


}