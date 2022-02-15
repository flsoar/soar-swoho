<?php
namespace Flsoar\Swoho\Facade;
use Swoole\Coroutine as Co;
use Swoole\Database\RedisConfig;
use Swoole\Database\RedisPool;


class Context
{
    /**
     * @var
     */
    protected static $context;

    /**
     * register context
     * @author flyman
     * @param string $node
     * @param null $data
     */
    public static function register($node = '', $context = null)
    {
        if (is_null(self::$context)) {
            self::$context = new \stdClass();
        }

        self::$context->$node = $context;
    }

    /**
     * get context
     * @author flyman
     * @param string $node
     * @param string $key
     * @return mixed
     */
    public static function get($node = '', $key  = '')
    {
        if (is_null(self::$context)) {
            return false;
        }

        if (! isset(self::$context->$node)) {
            return false;
        }

        if (empty($key)) {
            return self::$context->$node;
        }

        if (! isset(self::$context->$node->$key)) {
            return false;
        }

        return self::$context->$node->$key;
    }

    public static function storage()
    {
        Co\run(function()
        {
            $pool = new RedisPool((new RedisConfig)
                ->withHost('r-2zevlhy4h38w1us2d2pd.redis.rds.aliyuncs.com')
                ->withPort(6379)
                ->withAuth('MNOSKJS23L76Ldsfk11')
                ->withDbIndex(2)
                ->withTimeout(1)
            );
            $redis = $pool->get();
            $redis->set('test', '1111');
            var_dump($redis->get('test'));
        });
    }
}