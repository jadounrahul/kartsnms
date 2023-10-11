<?php

namespace KartsNMS\Interfaces\Polling\Netstats;

interface IpForwardNetstatsPolling
{
    public function pollIpForwardNetstats(array $oids): array;
}
