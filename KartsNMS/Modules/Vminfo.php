<?php
/*
 * Vminfo.php
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

namespace KartsNMS\Modules;

use App\Models\Device;
use App\Observers\ModuleModelObserver;
use KartsNMS\Config;
use KartsNMS\DB\SyncsModels;
use KartsNMS\Interfaces\Data\DataStorageInterface;
use KartsNMS\Interfaces\Discovery\VminfoDiscovery;
use KartsNMS\Interfaces\Polling\VminfoPolling;
use KartsNMS\OS;
use KartsNMS\Polling\ModuleStatus;

class Vminfo implements \KartsNMS\Interfaces\Module
{
    use SyncsModels;

    /**
     * @inheritDoc
     */
    public function dependencies(): array
    {
        return [];
    }

    public function shouldDiscover(OS $os, ModuleStatus $status): bool
    {
        // libvirt does not use snmp, only ssh tunnels
        if (! Config::get('enable_libvirt') && $os->getDevice()->snmp_disable) {
            return false;
        }

        return $status->isEnabled() && $os->getDevice()->status && $os instanceof VminfoDiscovery;
    }

    /**
     * @inheritDoc
     */
    public function discover(OS $os): void
    {
        if ($os instanceof VminfoDiscovery) {
            $vms = $os->discoverVminfo();

            ModuleModelObserver::observe(\App\Models\Vminfo::class);
            $this->syncModels($os->getDevice(), 'vminfo', $vms);
        }
        echo PHP_EOL;
    }

    public function shouldPoll(OS $os, ModuleStatus $status): bool
    {
        return $status->isEnabled() && ! $os->getDevice()->snmp_disable && $os->getDevice()->status && $os instanceof VminfoPolling;
    }

    /**
     * @inheritDoc
     */
    public function poll(OS $os, DataStorageInterface $datastore): void
    {
        if ($os->getDevice()->vminfo->isEmpty()) {
            return;
        }

        if ($os instanceof VminfoPolling) {
            $vms = $os->pollVminfo($os->getDevice()->vminfo);

            ModuleModelObserver::observe(\App\Models\Vminfo::class);
            $this->syncModels($os->getDevice(), 'vminfo', $vms);

            return;
        }

        // just run discovery again
        $this->discover($os);
    }

    /**
     * @inheritDoc
     */
    public function cleanup(Device $device): void
    {
        $device->vminfo()->delete();
    }

    /**
     * @inheritDoc
     */
    public function dump(Device $device)
    {
        return [
            'vminfo' => $device->vminfo()->orderBy('vmwVmVMID')
                ->get()->map->makeHidden(['id', 'device_id']),
        ];
    }
}
