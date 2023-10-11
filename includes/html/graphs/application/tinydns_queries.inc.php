<?php
/*
 * Copyright (C) 2015 Daniel Preussker <f0o@devilcode.org>
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
 */

use KartsNMS\Config;

/*
 * TinyDNS Query Graph
 * @author Daniel Preussker <f0o@devilcode.org>
 * @copyright 2015 f0o, KartsNMS
 * @license GPL
 * @package KartsNMS
 * @subpackage Graphs
 */

require 'includes/html/graphs/common.inc.php';

$i = 0;
$scale_min = 0;
$nototal = 1;
$unit_text = 'Query/sec';
$rrd_filename = Rrd::name($device['hostname'], ['app', 'tinydns', $app->app_id]);
// $array        = explode(":","hinfo:rp:sig:key:axfr:total");
$array = [
    'any',
    'a',
    'aaaa',
    'cname',
    'mx',
    'ns',
    'ptr',
    'soa',
    'txt',
];
$colours = 'merged';
$rrd_list = [];

Config::set('graph_colours.merged', array_merge(Config::get('graph_colours.greens'), Config::get('graph_colours.blues')));

if (Rrd::checkRrdExists($rrd_filename)) {
    foreach ($array as $ds) {
        $rrd_list[$i]['filename'] = $rrd_filename;
        $rrd_list[$i]['descr'] = strtoupper($ds);
        $rrd_list[$i]['ds'] = $ds;
        $i++;
    }
} else {
    echo "file missing: $file";
}

require 'includes/html/graphs/generic_multi_simplex_seperated.inc.php';
