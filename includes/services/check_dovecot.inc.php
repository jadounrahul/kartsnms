<?php

$check_cmd = \KartsNMS\Config::get('nagios_plugins') . '/check_dovecot ' . $service['service_param'];
