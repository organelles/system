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
        $position = $this->getPositionForAdd();
        $ip       = !empty($ip) ? $ip : $this->dockerIP;
        injectStringInFile($this->hostsPath, $ip . ' ' . $host, $position);
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
            $file = $this->startStamp . PHP_EOL . $this->endStamp . PHP_EOL . $hosts;
        }

        // Seek position
        if ($position = strpos($hosts, $this->endStamp)) {
            return (int)$position;
        }

        throw new \Exception('We can\'t find need position in a hosts file');
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