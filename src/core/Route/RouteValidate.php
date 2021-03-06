<?php
namespace Flsoar\Swoho\Core\Route;
use Flsoar\Swoho\Common\Result;
use Flsoar\Swoho\Facade\Context;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\DatabasePresenceVerifier;
use Illuminate\Validation\Factory;

class RouteValidate
{

    /**
     * route validate
     * @author flyman
     * @return mixed
     */
    public static function handle()
    {
        $filesystem = new Filesystem();
        $fileloader = new FileLoader($filesystem, '');
        $translator = new Translator($fileloader, 'en_US');
        $factory    = new Factory($translator);
        #$factory->setPresenceVerifier(new DatabasePresenceVerifier());
        $config = config('validate');
        $uri    = Context::get('request')->requestUri;
        if (isset($config[$uri])) {
            $config = $config[$uri];
            $validator = $factory->make(Context::get('request')->input(), $config['rule'], $config['msg'], $config['attr']);
            if ($validator->fails()) {
                return Result::error($validator->errors()->first());
            }
        }

    }
}