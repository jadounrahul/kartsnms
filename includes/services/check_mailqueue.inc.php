<?php

$check_cmd = 'sudo ' . \KartsNMS\Config::get('nagios_plugins') . '/check_mailqueue ' . $service['service_param'];
