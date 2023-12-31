<?php
/**
 * Axos.php
 *
 * Calix AXOS OS
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
 * @copyright  2022 Nick Peelman
 * @author     Nick Peelman <nick@peelman.us>
 */

namespace KartsNMS\OS;

use App\Models\Device;
use KartsNMS\Interfaces\Discovery\OSDiscovery;
use KartsNMS\OS;

class Axos extends OS implements OSDiscovery
{
    public function discoverOS(Device $device): void
    {
        parent::discoverOS($device);
        $cards = explode("\n", snmp_walk($this->getDeviceArray(), 'axosCardActualType', '-OQv', 'Axos-Card-MIB'));
        $card_count = [];
        foreach ($cards as $card) {
            $card_count[$card] = ($card_count[$card] ?? 0) + 1;
        }
        $device->features = implode(', ', array_map(function ($card) use ($card_count) {
            return ($card_count[$card] > 1 ? $card_count[$card] . 'x ' : '') . $card;
        }, array_keys($card_count)));
    }
}
