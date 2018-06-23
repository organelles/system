<?php

namespace Organelles\System\Hosts;

use Organelles\System\Hosts;

/**
 * Work with a host file in Linux
 *
 * @package Organelles\System\Hosts
 */
class Linux extends Hosts
{

    /**
     * @var string
     */
    protected $defaultIp;

    /**
     * @var string
     */
    protected $hostsPath;

    /**
     * Add host to host file
     *
     * @param string      $host
     * @param string|null $ip
     * @return void
     */
    public function add($host, $ip = null): void
    {

    }

    /**
     * Delete host from host file
     *
     * @param string $host
     * @return void
     */
    public function delete($host): void
    {

    }

}