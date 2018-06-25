<?php

namespace Organelles\System\Hosts;

use Organelles\System\Hosts;

/**
 * Work with a host file in Windows
 *
 * @package Organelles\System\Hosts
 */
class Windows extends Hosts
{

    /**
     * @var string
     */
    protected $defaultIp = '10.0.75.2';

    /**
     * @var string
     */
    protected $hostsPath = 'C:\Windows\System32\drivers\etc\hosts';

}