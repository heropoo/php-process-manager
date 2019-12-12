<?php
/**
 * Date: 2019-12-12
 * Time: 17:19
 */

namespace Moon;


class Process
{
    public static function startProcess($command, $log_file = '/dev/null', $error_log_file = '/dev/null')
    {
        $full_command = " {$command}  1>> $log_file  2>>  $error_log_file &";

        exec($full_command, $output, $status);
        echo "exec {$full_command} status {$status}\n";

        return $status;
    }

    public static function getProcessPid($command)
    {
        $pids = [];
        exec("ps -ef | grep '{$command}' | grep -v grep | awk '{print $2}'", $pids);

        if (!empty ($pids) && is_array($pids)) {
            return $pids;
        } else {
            return false;
        }
    }

    public static function killProcess($command)
    {
        $pids = self::getProcessPid($command);

        $isKill = true;

        if (!empty ($pids) && is_array($pids)) {
            foreach ($pids as $pid) {
                exec("kill {$pid}", $output, $return_var);

                if ($return_var === 0) {
                    echo "kill : {$command} SUCCESS \n";
                } else {
                    $isKill = false;
                    echo "kill : {$command} FAILED \n";
                }
            }
        }

        return $isKill;
    }

    public static function killProcessByPid($pid)
    {
        exec("kill $pid", $output, $return_var);
        if ($return_var == 0) {
            echo "kill $pid done\n";
            return $pid;
        } else {
            return false;
        }
    }
}