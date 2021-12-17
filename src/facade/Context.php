<?php
namespace Flsoar\Swoho\Facade;

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
}