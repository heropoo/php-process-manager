<?php
/**
 * Date: 2019-10-16
 * Time: 16:53
 */

if (!function_exists('is_cli')) {
    /**
     * check if php running in cli mode
     */
    function is_cli()
    {
        return preg_match("/cli/i", php_sapi_name()) ? true : false;
    }
}

if (!is_cli()) {
    die('Please run `php ' . __FILE__ . '` in cli mode.');
}

$argv = $_SERVER['argv'];
$argc = $_SERVER['argc'];

$sub_cmd = 'help';

if ($argc == 2) {

}


