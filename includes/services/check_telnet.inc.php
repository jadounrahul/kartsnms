<?php

if ($service['service_port']) {
    $port = $service['service_port'];
} else {
    $port = '23';
}
$check_cmd = \KartsNMS\Config::get('nagios_plugins') . '/check_telnet -H ' . $service['hostname'] . ' -p ' . $port . ' ' . $service['service_param'];
