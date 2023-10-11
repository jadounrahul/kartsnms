<?php

require 'includes/html/graphs/common.inc.php';

$colours = 'mixed';
$nototal = (($width < 224) ? 1 : 0);
$rrd_filename = Rrd::name($device['hostname'], ['app', 'chronyd', $app->app_id, $vars['source']]);
$array = [
    'polling_rate'          => ['descr' => 'Polling rate'],
    'last_rx'               => ['descr' => 'Last RX'],
    'number_samplepoints'   => ['descr' => '# sample pts'],
    'number_runs'           => ['descr' => '# runs'],
    'span'                  => ['descr' => 'Sample span'],
];

$rrd_list = [];
if (Rrd::checkRrdExists($rrd_filename)) {
    foreach ($array as $ds => $var) {
        $rrd_list[$i]['filename'] = $rrd_filename;
        $rrd_list[$i]['descr'] = $var['descr'];
        $rrd_list[$i]['ds'] = $ds;
        $rrd_list[$i]['colour'] = \KartsNMS\Config::get("graph_colours.$colours.$i");
        $i++;
    }
} else {
    d_echo('RRD "' . $rrd_filename . '" not found');
}

require 'includes/html/graphs/generic_multi_line.inc.php';
