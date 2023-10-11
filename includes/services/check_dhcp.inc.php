<?php

$check_cmd = \KartsNMS\Config::get('nagios_plugins') . '/check_dhcp ' . $service['service_param'];
