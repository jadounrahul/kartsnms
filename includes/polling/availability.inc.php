<?php

use KartsNMS\OS;

if (! $os instanceof OS) {
    $os = OS::make($device);
}
(new \KartsNMS\Modules\Availability())->poll($os, app('Datastore'));
