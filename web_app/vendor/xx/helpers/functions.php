<?php
function debug($data, $die = false)
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
    if($die) {
        die;
    }
}

function hsch($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

function redirect($http = false)
{
    if ($http) $redirect = $http;
    else $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;


    header("Location: ". $redirect);
    die;
}
//
//function base_url()
//{
//    return PATH . '/' . (\dc\App::$app->getProperty('lang') ? \dc\App::$app->getProperty('lang') . '/' : '');
//}

/**
 * @param string $key Key of GET array
 * @param string $type Values 'i', 'f', 's'
 * @return float|int|string
 */
function get($key, $type = 'i'): int|float|string
{
    $param = $key;
    $$param = $_GET[$param] ?? '';
    if ($type == 'i'){
        return (int)$$param;
    } elseif ($type == 'f') {
        return (float)$$param;
    } else {
        return trim($$param);
    }
}

/**
 * @param string $key Key of POST array
 * @param string $type Values 'i', 'f', 's'
 * @return float|int|string
 */
function post($key, $type = 's'): int|float|string
{
    $param = $key;
    $$param = $_POST[$param] ?? '';
    if ($type == 'i'){
        return (int)$$param;
    } elseif ($type == 'f') {
        return (float)$$param;
    } else {
        return trim($$param);
    }
}

function __($key)
{
    echo \dc\Language::get($key);
}

function ___($key)
{
    return \dc\Language::get($key);
}

function get_cart_icon($id)
{
    if(!empty($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart'])) {
        $icon = '<i class="fas fa-luggage-cart"></i>';
    }else{
        $icon = '<i class="fas fa-shopping-cart"></i>';
    }
    return $icon;
}

function get_field_value($name)
{
    return isset($_SESSION['form_data'][$name]) ? hsch($_SESSION['form_data'][$name]) : '';
}

function get_field_array_value($name, $key, $index)
{
    return isset($_SESSION['form_data'][$name][$key][$index]) ? hsch($_SESSION['form_data'][$name][$key][$index]) : '';
}
function replace_quotes($text)
{
    $text = htmlspecialchars_decode($text, ENT_QUOTES);
    $text = str_replace(array('«', '»'), '"', $text);
    return preg_replace_callback('/(([\"]{2,})|(?![^\W])(\"))|([^\s][\"]+(?![\w]))/u', 'replace_quotes_callback', $text);
}

function replace_quotes_callback($matches)
{
    if (count($matches) == 3) {
        return '«»';
    } elseif (!empty($matches[1])) {
        return str_replace('"', '«', $matches[1]);
    } else {
        return str_replace('"', '»', $matches[4]);
    }
}

function clean_request($value = "") {
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);

    return $value;
}