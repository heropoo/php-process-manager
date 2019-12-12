<?php
/**
 * Date: 2019-10-16
 * Time: 17:09
 */

namespace Moon\Tests;

use Moon\ProcessManager;
use PHPUnit\Framework\TestCase;

class ManagerTest extends TestCase
{
    protected $config = [
        [
            'command' => 'hello.php',
            'interval_time' => 3, // Run every three seconds
        ],
        [
            'command' => 'while.php',
            'interval_time' => 10,
        ]
    ];
    protected $prefix = 'php tests/commands/';
    protected $monitor = 'monitor.php';

    public function testStartProcess()
    {
        $manager = new ProcessManager($this->monitor, $this->config, $this->prefix);
        $manager->manageProcess('start');

    }

    public function testProcessStatus()
    {
        $manager = new ProcessManager($this->monitor, $this->config, $this->prefix);
        $manager->workProcessStatus();
    }
//
//    public function testGetPid()
//    {
//    }
//
//    public function testKillPid()
//    {
//
//    }
}