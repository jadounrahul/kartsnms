<?php

$procs = dbFetchRows('SELECT * FROM `processors` where `device_id` = ?', [$device['device_id']]);

if (empty($procs)) {
    throw new \KartsNMS\Exceptions\RrdGraphException('No Processors');
}

if (\KartsNMS\Config::getOsSetting($device['os'], 'processor_stacked')) {
    include 'includes/html/graphs/device/processor_stack.inc.php';
} else {
    include 'includes/html/graphs/device/processor_separate.inc.php';
}
