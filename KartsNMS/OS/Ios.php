<?php
/**
 * Ios.php
 *
 * Cisco IOS
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 * @link       https://www.itkarts.com
 *
 * @copyright  2017 Tony Murray
 * @author     Tony Murray <murraytony@gmail.com>
 */

namespace KartsNMS\OS;

use Illuminate\Support\Str;
use KartsNMS\Device\WirelessSensor;
use KartsNMS\Interfaces\Discovery\Sensors\WirelessCellDiscovery;
use KartsNMS\Interfaces\Discovery\Sensors\WirelessChannelDiscovery;
use KartsNMS\Interfaces\Discovery\Sensors\WirelessClientsDiscovery;
use KartsNMS\Interfaces\Discovery\Sensors\WirelessRsrpDiscovery;
use KartsNMS\Interfaces\Discovery\Sensors\WirelessRsrqDiscovery;
use KartsNMS\Interfaces\Discovery\Sensors\WirelessRssiDiscovery;
use KartsNMS\Interfaces\Discovery\Sensors\WirelessSnrDiscovery;
use KartsNMS\OS\Shared\Cisco;
use KartsNMS\OS\Traits\CiscoCellular;

class Ios extends Cisco implements
    WirelessCellDiscovery,
    WirelessChannelDiscovery,
    WirelessClientsDiscovery,
    WirelessRssiDiscovery,
    WirelessRsrqDiscovery,
    WirelessRsrpDiscovery,
    WirelessSnrDiscovery
{
    use CiscoCellular;

    /**
     * @return array Sensors
     */
    public function discoverWirelessClients()
    {
        $device = $this->getDeviceArray();

        if (! Str::startsWith($device['hardware'], 'AIR-') && ! Str::contains($device['hardware'], 'ciscoAIR')) {
            // unsupported IOS hardware
            return [];
        }

        $data = snmpwalk_cache_oid($device, 'cDot11ActiveWirelessClients', [], 'CISCO-DOT11-ASSOCIATION-MIB');
        $entPhys = snmpwalk_cache_oid($device, 'entPhysicalDescr', [], 'ENTITY-MIB');

        // fixup incorrect/missing entPhysicalIndex mapping
        foreach ($data as $index => $_unused) {
            foreach ($entPhys as $entIndex => $ent) {
                $descr = $ent['entPhysicalDescr'];
                unset($entPhys[$entIndex]); // only use each one once

                if (Str::endsWith($descr, 'Radio')) {
                    d_echo("Mapping entPhysicalIndex $entIndex to ifIndex $index\n");
                    $data[$index]['entPhysicalIndex'] = $entIndex;
                    $data[$index]['entPhysicalDescr'] = $descr;
                    break;
                }
            }
        }

        $sensors = [];
        foreach ($data as $index => $entry) {
            $sensors[] = new WirelessSensor(
                'clients',
                $device['device_id'],
                ".1.3.6.1.4.1.9.9.273.1.1.2.1.1.$index",
                'ios',
                $index,
                $entry['entPhysicalDescr'],
                $entry['cDot11ActiveWirelessClients'],
                1,
                1,
                'sum',
                null,
                40,
                null,
                30,
                $entry['entPhysicalIndex'],
                'ports'
            );
        }

        return $sensors;
    }
}
