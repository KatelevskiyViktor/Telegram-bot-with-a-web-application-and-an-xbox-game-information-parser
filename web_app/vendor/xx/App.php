<?php


namespace xx;


use xx\ErrorHandler;
use xx\Registry;
use xx\Router;

class App
{
    public static $app;

    public function __construct()
    {
        new ErrorHandler();
        session_start();
        self::$app = Registry::getInstance();
        $this->getParams();
        Router::dispatch();
    }

    protected function getParams()
    {
        $params = require_once CONFIG . '/params.php';
        if(!empty($params)){
            foreach ($params as $k => $v){
                self::$app->setProperty($k, $v);

            }
        }
    }


}