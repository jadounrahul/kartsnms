<?php
/*
 * Linux.php
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
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    KartsNMS
 * @link       http://kartsnms.org
 * @copyright  2023 Tony Murray
 * @author     Tony Murray <murraytony@gmail.com>
 */

namespace KartsNMS\OS;

use Illuminate\Support\Collection;
use KartsNMS\Interfaces\Discovery\VminfoDiscovery;
use KartsNMS\OS\Traits\VminfoLibvirt;
use KartsNMS\OS\Traits\VminfoVmware;

class Linux extends Shared\Unix implements VminfoDiscovery
{
    // NOTE: Only Linux specific stuff should go here, most things should be in Unix

    use VminfoLibvirt, VminfoVmware {
        VminfoLibvirt::discoverVminfo as discoverLibvirtVminfo;
        VminfoVmware::discoverVmInfo as discoverVmwareVminfo;
    }

    public function discoverVmInfo(): Collection
    {
        $vms = $this->discoverLibvirtVminfo();

        if ($vms->isNotEmpty()) {
            return $vms;
        }

        echo PHP_EOL;

        return $this->discoverVmwareVminfo();
    }
}
