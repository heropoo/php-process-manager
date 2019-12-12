<?php
/**
 * Date: 2019-10-16
 * Time: 17:22
 */

namespace Moon;

class ProcessManager
{
    protected $commandPrefix;
    protected $commandsConfig = [];

    protected $monitorProcess;

    protected $logFile;
    protected $errorLogFile;

    public function __construct(
        $monitorProcess, array $commandsConfig, $commandPrefix = '',
        $logFile = '/dev/null', $errorLogFile = '/dev/null'
    )
    {
        $this->monitorProcess = $monitorProcess;

        $this->commandsConfig = $commandsConfig;
        $this->commandPrefix = $commandPrefix;

        $this->logFile = $logFile;
        $this->errorLogFile = $errorLogFile;
    }

    /**
     * 管理进程
     * @param string $action start|stop|restart|status
     * @throws ManagerException
     */
    public function manageProcess($action)
    {
        if (!in_array($action, ['start', 'stop', 'restart', 'status'])) {
            throw new ManagerException('Unsupported action ' . $action);
        }

        switch ($action) {
            case "start" :
                $this->stopMonitorProcess();
                $this->stopWorkProcess();
                $this->startMonitorProcess(); //worker进程启动都交给MonitorProcess，同时也防止了重复启动worker进程
                break;
            case "stop" :
                $this->stopMonitorProcess();
                $this->stopWorkProcess();
                break;
            case 'restart':
                $this->stopMonitorProcess();
                $this->stopWorkProcess();
                $this->startMonitorProcess();
                break;
            case "status" :
                $this->workProcessStatus();
                break;
            default :
                echo "need Argv start|stop|restart|status\n";
                break;
        }
    }

    /**
     * 检查进程状态
     */
    public function workProcessStatus()
    {
        foreach ($this->commandsConfig as $v) {
            $command = $this->commandPrefix . $v['command'];
            $pids = Process::getProcessPid($command);
            if (false == $pids) {
                echo "\x1B[31m进程未正常启动" . $command . "  \x1B[0m \n";
            } else {
                echo "进程状态正常:" . $command . " \n";
            }
        }
    }

    /**
     * 开启监控进程
     */
    public function startMonitorProcess()
    {
        $command = $this->commandPrefix . $this->monitorProcess;
        Process::startProcess($command, $this->logFile, $this->errorLogFile);
    }

    /**
     * 关闭监控进程
     */
    public function stopMonitorProcess()
    {
        $command = $this->commandPrefix . $this->monitorProcess;
        $pids = Process::getProcessPid($command);
        if ($pids) {
            foreach ($pids as $pid) {
                Process::killProcessByPid($pid);
            }
        }
    }

    /**
     * 开启工作进程
     */
    public function startWorkProcess()
    {
        foreach ($this->commandsConfig as $command) {
            $command = $this->commandPrefix . $command;
            Process::startProcess($command, $this->logFile, $this->errorLogFile);
        }
    }

    /**
     * 关闭工作进程
     */
    public function stopWorkProcess()
    {
        foreach ($this->commandsConfig as $command) {
            $command = $this->commandPrefix . $command;
            $pids = Process::getProcessPid($command);
            if ($pids) {
                foreach ($pids as $pid) {
                    Process::killProcessByPid($pid);
                }
            }
        }
    }
}