<?php

namespace KartsNMS\OS;

use KartsNMS\Device\WirelessSensor;
use KartsNMS\Interfaces\Discovery\Sensors\WirelessQualityDiscovery;
use KartsNMS\Interfaces\Discovery\Sensors\WirelessRssiDiscovery;
use KartsNMS\Interfaces\Discovery\Sensors\WirelessSnrDiscovery;
use KartsNMS\OS;

class ArrisDsr4410md extends OS implements
    WirelessRssiDiscovery,
    WirelessSnrDiscovery,
    WirelessQualityDiscovery
{
    public function discoverWirelessRssi()
    {
        $oid = '.1.3.6.1.4.1.1166.1.621.11.9.0';

        return [
            new WirelessSensor(
                'rssi',
                $this->getDeviceId(),
                $oid,
                'arris-dsr4410md',
                0,
                'Receive Signal Level',
                divisor: 10
            ),
        ];
    }

    public function discoverWirelessSnr()
    {
        $oid = '.1.3.6.1.4.1.1166.1.621.16.6.8.0';

        return [
            new WirelessSensor(
                'snr',
                $this->getDeviceId(),
                $oid,
                'arris-dsr4410md',
                0,
                'Receive SNR',
                divisor: 10
            ),
        ];
    }

    public function discoverWirelessQuality()
    {
        $oid = '.1.3.6.1.4.1.1166.1.621.11.8.0';

        return [
            new WirelessSensor(
                'quality',
                $this->getDeviceId(),
                $oid,
                'arris-dsr4410md',
                0,
                'Receive Quality'
            ),
        ];
    }
}
