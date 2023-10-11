<?php

$check_cmd = \KartsNMS\Config::get('nagios_plugins') . '/check_inodes ' . $service['service_param'];
