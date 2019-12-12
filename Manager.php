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


}