<?php


namespace xx;




class View
{
    public static function render($layout_name, $page_name, $data = []){
        require_once PATH_TO_LAYOUTS . $layout_name . '.php';
    }
}