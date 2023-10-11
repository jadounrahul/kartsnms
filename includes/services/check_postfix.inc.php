<?php

$check_cmd = 'sudo ' . \KartsNMS\Config::get('nagios_plugins') . '/check_postfix ' . $service['service_param'];
