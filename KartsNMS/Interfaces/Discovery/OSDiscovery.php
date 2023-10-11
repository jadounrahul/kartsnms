<?php
/**
 * OsDiscovery.php
 *
 * Discovers information about an OS and updates it in the database
 * Examples of things that should be updated: version, hardware, features, serial
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
 * @copyright  2020 Tony Murray
 * @author     Tony Murray <murraytony@gmail.com>
 */

namespace KartsNMS\Interfaces\Discovery;

use App\Models\Device;

interface OSDiscovery
{
    /**
     * Discover additional information about the OS.
     * Primarily this is just version, hardware, features, serial, but could be anything
     *
     * @param  \App\Models\Device  $device
     */
    public function discoverOS(Device $device): void;
}