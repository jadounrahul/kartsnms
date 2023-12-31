<?php
/**
 * procurve.inc.php
 *
 * KartsNMS sensors pre-cache discovery module for HP Procurve
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
 * @copyright  2017 Neil Lathwood
 * @author     Neil Lathwood <gh+n@laf.io>
 */
echo 'hpicfSensorTable ';
$pre_cache['procurve_hpicfSensorTable'] = snmpwalk_cache_oid($device, 'hpicfSensorTable', [], 'HP-ICF-CHASSIS', null, '-OeQUs');

echo 'hpicfXcvrInfoTable ';
$pre_cache['procurve_hpicfXcvrInfoTable'] = snmpwalk_cache_oid($device, 'hpicfXcvrInfoTable', [], 'HP-ICF-TRANSCEIVER-MIB', null, '-OeQUs');
