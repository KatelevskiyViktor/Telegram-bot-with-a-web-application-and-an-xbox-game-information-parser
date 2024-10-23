<?php
if(PHP_MAJOR_VERSION < 8){
    die('Необходима версия php >=8');
}
require_once dirname(__DIR__) . '/config/init.php';
require_once HELPERS . '/functions.php';

new \xx\App();
