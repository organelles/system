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
        $ip       = !empty($ip) ? $ip : $this->defaultIp;
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
     * @param string $host
     * @return void
     */
    public function delete($host): void
    {
        deleteStringFromFile($this->hostsPath, $host);
    }

}