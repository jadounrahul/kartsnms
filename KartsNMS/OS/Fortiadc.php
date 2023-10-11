<?php

namespace KartsNMS\OS;

use App\Models\Device;
use KartsNMS\Interfaces\Discovery\OSDiscovery;
use KartsNMS\OS\Shared\Fortinet;

class Fortiadc extends Fortinet implements OSDiscovery
{
    public function discoverOS(Device $device): void
    {
        parent::discoverOS($device); // yaml

        $device->hardware = $device->hardware ?: $this->getHardwareName();
    }
}
