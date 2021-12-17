<?php
namespace Flsoar\Swoho\Common\Traits;

/**
 * Class OneKeyInstance
 * @author flyman
 * @package App\Common\Traits
 */
trait OneKeyInstance
{
    private static $instance;

    /**
     * @return static
     */
    public static function instance()
    {
        if (!self::$instance) {
            self::$instance = new static();
        }
        return self::$instance;
    }
}