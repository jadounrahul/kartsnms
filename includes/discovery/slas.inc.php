<?php

use KartsNMS\OS;

if (! $os instanceof OS) {
    $os = OS::make($device);
}
(new \KartsNMS\Modules\Slas())->discover($os);
