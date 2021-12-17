<?php
namespace Flsoar\Swoho\Common;
use Flsoar\Swoho\Facade\Context;

class Result implements \JsonSerializable{

    /**
     * @var int
     */
    private $successCode = 200;

    /**
     * @var int
     */
    private $errorCode = 0;

    private $_raw = array(
        'code'  => 200,
        'msg'   => null,
        'data'  => null
    );

    /**
     * @param string $error
     * @param int    $errno
     * @return Result
     */
    public static function error($error, $errno = 0, $data = [])
    {
        return new self($errno, $error, $data);
    }

    /**
     * @author nucarf
     * @return bool
     */
    public function isError()
    {
        return ($this->getErrno() == $this->errorCode) ? true : false;
    }

    /**
     * @param $data
     * @return Result
     */
    public static function success($data=[])
    {
        return new self(200, 'ok', $data);
    }

    /**
     * @author nucarf
     * @return bool
     */
    public function isSuccess()
    {
        return ($this->getErrno() == $this->successCode) ? true : false;
    }


    /**
     * 构造函数
     * @param int    $errno 错误编码
     * @param string $error 错误信息
     * @param mixed  $data 附加数据
     */
    public function __construct($errno=200, $error='ok', $data=[])
    {
        //header("Content-Type:application/json");
        $this->_raw['code'] = $errno;
        $this->_raw['msg'] = $error;
        $this->_raw['data'] = $data;

    }

    /**
     * 获取错误编码
     * @return int
     */
    public function getErrno()
    {
        return $this->_raw['code'];
    }

    /**
     * 设置错误编码
     * @param int $errno 错误编码
     */
    public function setErrno($errno)
    {
        $this->_raw['code'] = $errno;
    }

    /**
     * 获取错误信息
     * @return string
     */
    public function getError()
    {
        return $this->_raw['msg'];
    }

    /**
     * 设置错误信息
     * @param string $error 错误信息
     */
    public function setError($error)
    {
        $this->_raw['msg'] = $error;
    }

    /**
     * 获取附加数据
     * @return mixed|null
     */
    public function getData()
    {
        return $this->_raw['data'];
    }

    /**
     * 设置附加数据
     * @param mixed $data 附加数据
     */
    public function setData($data)
    {
        $this->_raw['data'] = $data;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return $this->_raw;
    }

    /**
     * json output
     */
    public function send(){
        $response = Context::get('response');
        $response->header('Content-type', 'Application/json;charset=utf-8', false);
        $response->end(
            json_encode($this->_raw, JSON_UNESCAPED_UNICODE)
        );

    }
    public function toArray()
    {
        return $this->_raw;
    }
}
