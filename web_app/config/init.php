<?php

define("DEBUG", 1);
define("ROOT", dirname(__DIR__));
define("WWW", ROOT . '/public');
define("APP", ROOT . '/app');
define("CORE", ROOT . '/vendor/xx');
define("HELPERS", ROOT . '/vendor/xx/helpers');
define("CACHE", ROOT . '/tmp/cache');
define("LOGS", ROOT . '/tmp/logs');
define("CONFIG", ROOT . '/config');
define("PATH_TO_LAYOUTS", ROOT . '/app/views/layouts/');
define("PATH_TO_PAGES", ROOT . '/app/views/pages/');
define('PATH', 'https://xbox');
define('ADMIN', 'https://xbox/admin');
define('NO_IMAGE', 'uploads/no_image.jpg');

require_once ROOT . '/vendor/autoload.php';
