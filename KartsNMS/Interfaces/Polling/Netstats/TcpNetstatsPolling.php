<?php

namespace KartsNMS\Interfaces\Polling\Netstats;

interface TcpNetstatsPolling
{
    public function pollTcpNetstats(array $oids): array;
}
