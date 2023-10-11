<?php

namespace KartsNMS\OS;

use App\Models\Device;
use KartsNMS\Interfaces\Discovery\OSDiscovery;
use KartsNMS\OS;

class Eurostor extends OS implements OSDiscovery
{
    public function discoverOS(Device $device): void
    {
        $info = snmp_getnext_multi($this->getDeviceArray(), ['siVendor', 'siModel', 'siSerial', 'siFirmVer'], '-OQUs', 'proware-SNMP-MIB');
        $device->version = trim($info['siFirmVer'], '"');
        $device->hardware = trim($info['siModel'], '"');
        $device->features = trim($info['siVendor'], '"');
        $device->serial = trim($info['siSerial'], '"');

        if (preg_match('/^ES/', $device->hardware)) {
            $device->hardware = 'EUROstore [' . $device->hardware . ']';
        }

        if (preg_match('/^ARC/', $device->features)) {
            $device->features = 'Controller: Areca ' . $device->features;
        }

        // Sometimes firmware outputs serial as hex-string
        if (isHexString($device->serial)) {
            $device->serial = snmp_hexstring($device->serial);
        }
    }
}
