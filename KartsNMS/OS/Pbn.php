<?php
/**
 * Pbn.php
 *
 * -Description-
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
 * @copyright  2018 Tony Murray
 * @author     Tony Murray <murraytony@gmail.com>
 */

namespace KartsNMS\OS;

use KartsNMS\Device\Processor;
use KartsNMS\Interfaces\Discovery\ProcessorDiscovery;
use KartsNMS\OS;

class Pbn extends OS implements ProcessorDiscovery
{
    public function __construct(&$device)
    {
        parent::__construct($device);

        preg_match('/^.* Build (?<build>\d+)/', $this->getDevice()->version, $version);
        if ($version['build'] <= 16607) { // Buggy version :-(
            $this->stpTimeFactor = 1;
        }
    }

    /**
     * Discover processors.
     * Returns an array of KartsNMS\Device\Processor objects that have been discovered
     *
     * @return array Processors
     */
    public function discoverProcessors()
    {
        return [
            Processor::discover(
                'pbn-cpu',
                $this->getDeviceId(),
                '.1.3.6.1.4.1.11606.10.9.109.1.1.1.1.5.1', // NMS-PROCESS-MIB::nmspmCPUTotal5min
                0
            ),
        ];
    }
}
