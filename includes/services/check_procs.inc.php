<?php

$check_cmd = \KartsNMS\Config::get('nagios_plugins') . '/check_procs ' . $service['service_param'];
