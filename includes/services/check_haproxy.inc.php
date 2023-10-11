<?php

$check_cmd = \KartsNMS\Config::get('nagios_plugins') . '/check_haproxy ' . $service['service_param'];
