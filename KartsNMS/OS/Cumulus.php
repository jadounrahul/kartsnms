<?php
/*
 * Cumulus.php
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

use App\Models\Device;

class Cumulus extends \KartsNMS\OS
{
    public function discoverOS(Device $device): void
    {
        $data = snmp_getnext_multi($this->getDeviceArray(), ['entPhysicalDescr', 'entPhysicalSoftwareRev', 'entPhysicalSerialNum'], '-OQUs', 'ENTITY-MIB');
        $device->hardware = $data['entPhysicalDescr'];
        $device->serial = $data['entPhysicalSerialNum'];
        $device->version = preg_replace('/^Cumulus Linux /', '', $data['entPhysicalSoftwareRev']);
    }
}
