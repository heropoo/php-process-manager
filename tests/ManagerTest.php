<?php
/**
 * Date: 2019-10-16
 * Time: 17:09
 */

namespace Moon\Tests;

use Moon\Manager;
use Moon\Process;
use PHPUnit\Framework\TestCase;

class ManagerTest extends TestCase
{
    protected $config = [
        [
            'command' => 'php tests/commands/hello.php',
            'interval_time' => 3, // Run every three seconds
        ],
        [
            'command' => 'php tests/commands/while.php',
            'interval_time' => 10,
        ]
    ];

    public function testStartProcess()
    {
        $this->assertInstanceOf(Manager::class, $this->config);
        $manager = new Manager($this->config);

    }

    public function testWhileProcessInfo()
    {
        Process::getInfo('php tests/commands/hello.php');
    }
//
//    public function testProcessList()
//    {
//
//    }
//
//    public function testGetPid()
//    {
//
//    }
//
//    public function testKillPid()
//    {
//
//    }
}