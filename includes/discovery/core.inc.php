<?php

use KartsNMS\OS;
use KartsNMS\OS\Generic;

// start assuming no os
(new \KartsNMS\Modules\Core())->discover(Generic::make($device));

// then create with actual OS
$os = OS::make($device);
