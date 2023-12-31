<?php
/**
 * ChecksSnmpsim.php
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

namespace KartsNMS\Tests;

use KartsNMS\Util\Snmpsim;

trait SnmpsimHelpers
{
    /** @var Snmpsim snmpsim instance */
    protected $snmpsim = null;

    public function requireSnmpsim()
    {
        if (! getenv('SNMPSIM')) {
            $this->markTestSkipped('Snmpsim required for this test.  Set SNMPSIM=1 to enable.');
        }
    }

    public function getSnmpsim()
    {
        if (! $this->snmpsim) {
            global $snmpsim;
            $this->snmpsim = $snmpsim;
        }

        return $this->snmpsim;
    }
}
