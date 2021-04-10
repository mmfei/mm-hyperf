<?php
namespace App\Utils;

use Hyperf\Utils\ApplicationContext;
use Hyperf\Utils\Codec\Json;

class Log
{
    public static function get(string $name = 'app' , string $group = 'default'): \Psr\Log\LoggerInterface
    {
        return ApplicationContext::getContainer()->get(\Hyperf\Logger\LoggerFactory::class)->get($name , $group);
    }
    public static function start($data ,$name = 'app', $group = 'default') {
        self::get($name , $group)->debug("=======START=======".self::toString($data).PHP_EOL);
        return true;
    }
    public static function end($data ,$name = 'app', $group = 'default') {
        self::get($name , $group)->debug("=======END=======".self::toString($data).PHP_EOL);
        return true;
    }
    public static function debug($data ,$name = 'app', $group = 'default') {
        self::get($name , $group)->debug(self::toString($data));
        return true;
    }
    public static function info($data ,$name = 'app', $group = 'default') {
        self::get($name , $group)->info(self::toString($data));
        return true;
    }
    public static function error($data ,$name = 'app', $group = 'default') {
        self::get($name , $group)->error(self::toString($data));
        return true;
    }
    protected static function toString($data): string
    {
        if(is_array($data) || is_object($data)) {
            $s = Json::encode($data);
        } else
            $s = $data;
        return $s;
    }
}
