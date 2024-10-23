<?php

namespace xx;

class Router
{
    public static function dispatch()
    {
        $url = trim(urldecode($_SERVER['QUERY_STRING']), '/');
        $query = explode('/', $url);
        if (count($query) == 1) array_push($query, "");//to fix error "Undefined offset 1"
        $ctrl = $query[0];
        $act = $query[1];


        if($ctrl === '') $ctrl = 'index';

        $ctrl = ucfirst($ctrl);
        if(class_exists('app\controllers\\'. $ctrl)){


            $class = '\app\Controllers\\' . $ctrl;
            if(method_exists($class, $act))(new $class())->$act();
            else (new $class())->index();


        } else echo 'Не шали! =*';
    }
}