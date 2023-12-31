<?php
/*
 * KartsNMS
 *
 * This program is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the
 * Free Software Foundation, either version 3 of the License, or (at your
 * option) any later version.  Please see LICENSE.txt at the top level of
 * the source code distribution for details.
 *
 * @package    KartsNMS
 * @link       https://www.itkarts.com
 * @copyright  2017 Thomas GAGNIERE
 * @author     Thomas GAGNIERE <tgagniere@reseau-concept.com>
 */

namespace KartsNMS\OS;

use KartsNMS\Device\WirelessSensor;
use KartsNMS\Interfaces\Discovery\OSDiscovery;
use KartsNMS\Interfaces\Discovery\Sensors\WirelessClientsDiscovery;
use KartsNMS\OS\Shared\Zyxel;

class Zyxelnwa extends Zyxel implements OSDiscovery, WirelessClientsDiscovery
{
    public function discoverWirelessClients()
    {
        $oid = '.1.3.6.1.4.1.890.1.15.3.5.1.1.2.1'; //ZYXEL-ES-SMI::esMgmt.5.1.1.2.1

        return [
            new WirelessSensor('clients', $this->getDeviceId(), $oid, 'zyxelnwa', 1, 'Clients'),
        ];
    }
}
