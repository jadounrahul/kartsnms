<?php

namespace KartsNMS\Interfaces\Polling\Netstats;

interface UdpNetstatsPolling
{
    public function pollUdpNetstats(array $oids): array;
}
