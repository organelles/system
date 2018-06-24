<?php

namespace Organelles\System;

use Organelles\System\Hosts\Linux;
use Organelles\System\Hosts\Windows;

/**
 * Class Hosts
 */
abstract class Hosts
{

    /**
     * @var string
     */
    protected $startStamp = '# Start local runner';

    /**
     * @var string
     */
    protected $endStamp = '# End local runner';

    /**
     * @var string
     */
    protected $defaultIp;

    /**
     * @var string
     */
    protected $hostsPath;

    /**
     * Hosts constructor.
     *
     * @param string|null $defaultIp
     * @param string|null $hostsPath
     */
    protected function __construct($defaultIp = null, $hostsPath = null)
    {
        $this->defaultIp = (!empty($defaultIp)) ? $defaultIp : $this->defaultIp;
        $this->hostsPath = (!empty($hostsPath)) ? $hostsPath : $this->hostsPath;
    }

    /**
     * Factory
     */
    public static function factory()
    {
        switch (PHP_OS) {
            case 'WINNT':
                return new Windows();
            case 'Linux':
                return new Linux();
        }

        throw new \Exception('I don\'t now your OS');
    }

    /**
     * Add host to host file
     *
     * @param string      $host
     * @param string|null $ip
     * @return void
     */
    abstract public function add($host, $ip = null): void;

    /**
     * Delete host from host file
     *
     * @param string $host
     * @return void
     */
    abstract public function delete($host): void;

}