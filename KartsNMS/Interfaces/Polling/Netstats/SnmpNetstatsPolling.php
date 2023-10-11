<?php

namespace KartsNMS\Interfaces\Polling\Netstats;

interface SnmpNetstatsPolling
{
    public function pollSnmpNetstats(array $oids): array;
}
