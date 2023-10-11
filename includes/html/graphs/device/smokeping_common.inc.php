<?php

$smokeping = new \KartsNMS\Util\Smokeping(DeviceCache::getPrimary());
$smokeping_files = $smokeping->findFiles();
