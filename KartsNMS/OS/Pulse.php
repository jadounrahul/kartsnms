<?php
/*
 * Pulse.php
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
 * @package    KartsNMS
 * @link       https://www.itkarts.com
 * @copyright  2020 Tony Murray
 * @author     Tony Murray <murraytony@gmail.com>
 */

namespace KartsNMS\OS;

use KartsNMS\Interfaces\Data\DataStorageInterface;
use KartsNMS\Interfaces\Polling\OSPolling;
use KartsNMS\RRD\RrdDefinition;

class Pulse extends \KartsNMS\OS implements OSPolling
{
    public function pollOS(DataStorageInterface $datastore): void
    {
        $users = snmp_get($this->getDeviceArray(), 'iveConcurrentUsers.0', '-OQv', 'PULSESECURE-PSG-MIB');

        if (is_numeric($users)) {
            $rrd_def = RrdDefinition::make()->addDataset('users', 'GAUGE', 0);

            $fields = [
                'users' => $users,
            ];

            $tags = compact('rrd_def');
            $datastore->put($this->getDeviceArray(), 'pulse_users', $tags, $fields);
            $this->enableGraph('pulse_users');
        }
    }
}
