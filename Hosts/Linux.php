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
    protected $defaultIp = '172.17.0.2';

    /**
     * @var string
     */
    protected $hostsPath = '/etc/hosts';

}