<?php
namespace Flsoar\Swoho\Core\DB;
use Illuminate\Database\Capsule\Manager as Capsule;

class Eloquent
{

    /**
     * DB boot
     * @author flyman
     * @return bool|mixed
     */
    public static function boot()
    {
        $capsule = new Capsule();
        $config = config('database.mysql');
        if ($config) {
            $capsule->addConnection();
            $capsule->setAsGlobal();
            $capsule->bootEloquent();
        }

    }
}