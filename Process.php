<?php
/**
 * Date: 2019-10-16
 * Time: 17:22
 */
namespace Moon;

class Process
{
    public static function getInfo($command)
    {
        exec("ps -ef | grep '{$command}' | grep -v grep | awk '{print $9}'" , $output, $return_var);
        var_dump($output, $return_var);
//        if(!empty ($scripts) && is_array($scripts)) {
//            return $scripts;
//        } else {
//            return false;
//        }
    }
}