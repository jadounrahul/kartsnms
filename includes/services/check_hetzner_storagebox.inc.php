<?php

$check_cmd = \KartsNMS\Config::get('nagios_plugins') . '/check_hetzner_storagebox ' . $service['service_param'];
