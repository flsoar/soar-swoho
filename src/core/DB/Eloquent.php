<?php
namespace Swoho\Core\DB;
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
        $capsule->addConnection(config('database.mysql'));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}