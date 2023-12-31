<?php

namespace KartsNMS\OS;

use KartsNMS\Device\WirelessSensor;
use KartsNMS\Interfaces\Discovery\Sensors\WirelessApCountDiscovery;
use KartsNMS\Interfaces\Discovery\Sensors\WirelessClientsDiscovery;
use KartsNMS\OS;

class Fortiwlc extends OS implements
    WirelessClientsDiscovery,
    WirelessApCountDiscovery
{
    public function discoverWirelessClients()
    {
        $oid = '.1.3.6.1.4.1.15983.1.1.3.1.13.11.0'; //MERU-GLOBAL-STATISTIC-MIB::mwSystemGeneralTotalWirelessStations.0

        return [
            new WirelessSensor('clients', $this->getDeviceId(), $oid, 'fortiwlc', 1, 'Clients: Total'),
        ];
    }

    public function discoverWirelessApCount()
    {
        $oid = '.1.3.6.1.4.1.15983.1.1.3.1.13.9.0'; //MERU-GLOBAL-STATISTICS-MIB::mwSystemGeneralTotalOnlineAps.0

        return [
            new WirelessSensor('ap-count', $this->getDeviceId(), $oid, 'fortiwlc', 1, 'Connected APs'),
        ];
    }
}
