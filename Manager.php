<?php
/**
 * Date: 2019-10-16
 * Time: 17:32
 */

namespace Moon;


class Manager
{
    protected $commandsConfig = [];

    public function __construct(array $commandsConfig)
    {
        $this->commandsConfig = $commandsConfig;
    }

    /**
     * @param string $action start|stop|restart|status
     * @throws ManagerException
     */
    public function monitorProcess($action)
    {
        if (!in_array($action, ['start', 'stop', 'restart', 'status'])) {
            throw new ManagerException('Unsupported action '.$action);
        }
    }

    public function getProcessInfo($command)
    {
        exec("ps -ef | grep '{$command}' | grep -v grep | awk '{print $9}'", $output, $return_var);
        var_dump($output, $return_var);
//        if(!empty ($scripts) && is_array($scripts)) {
//            return $scripts;
//        } else {
//            return false;
//        }
    }


    public function processList()
    {

    }
}