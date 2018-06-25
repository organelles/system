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
     * @param string|array $hosts
     * @param string|null $ip
     * @return void
     */
    public function add($hosts, $ip = null): void
    {
        $position = $this->getPositionForAdd();
        $ip       = !empty($ip) ? $ip : $this->defaultIp;

        if (!is_array($hosts)) {
            $hosts = [$hosts];
        }

        foreach ($hosts as $host) {
            injectStringInFile($this->hostsPath, $ip . ' ' . $host, $position);
        }
    }

    /**
     * Get position for add host
     *
     * @return int
     */
    private function getPositionForAdd(): int
    {
        // Set stamps
        $hosts = file_get_contents($this->hostsPath);
        if (!strpos($hosts, $this->endStamp)) {
            injectStringInFile($this->hostsPath, $this->endStamp, 0);
            injectStringInFile($this->hostsPath, $this->startStamp, 0);

            $hosts = file_get_contents($this->hostsPath);
        }

        if ($position = strpos($hosts, $this->endStamp)) {
            return (int)$position;
        }

        throw new \Exception('We can\'t find need position in a hosts file');
    }

    /**
     * Delete host from host file
     *
     * @param string|array $hosts
     * @return void
     */
    public function delete($hosts): void
    {
        if (!is_array($hosts)) {
            $hosts = [$hosts];
        }

        foreach ($hosts as $host) {
            deleteStringFromFile($this->hostsPath, $host);
        }
    }

}