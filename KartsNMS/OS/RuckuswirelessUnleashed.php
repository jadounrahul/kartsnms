<?php

namespace KartsNMS\OS;

use KartsNMS\Device\WirelessSensor;
use KartsNMS\Interfaces\Discovery\Sensors\WirelessApCountDiscovery;
use KartsNMS\Interfaces\Discovery\Sensors\WirelessClientsDiscovery;
use KartsNMS\OS;

class RuckuswirelessUnleashed extends OS implements
    WirelessClientsDiscovery,
    WirelessApCountDiscovery
{
    public function discoverWirelessClients()
    {
        $oid = '.1.3.6.1.4.1.25053.1.15.1.1.1.15.2.0'; //RUCKUS-UNLEASHED-SYSTEM-MIB::ruckusUnleashedSystemStatsNumSta.0

        return [
            new WirelessSensor('clients', $this->getDeviceId(), $oid, 'ruckuswireless-unleashed', 1, 'Clients: Total'),
        ];
    }

    public function discoverWirelessApCount()
    {
        $oid = '.1.3.6.1.4.1.25053.1.15.1.1.1.15.1.0'; //RUCKUS-UNLEASHED-SYSTEM-MIB:: ruckusUnleashedSystemStatsNumAP.0

        return [
            new WirelessSensor('ap-count', $this->getDeviceId(), $oid, 'ruckuswireless-unleashed', 1, 'Connected APs'),
        ];
    }
}
