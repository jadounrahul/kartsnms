<?php

namespace KartsNMS\Snmptrap\Handlers;

use App\Models\Device;
use KartsNMS\Enum\Severity;
use KartsNMS\Interfaces\SnmptrapHandler;
use KartsNMS\Snmptrap\Trap;

class VeeamWinFLRCopyToStarted extends VeeamTrap implements SnmptrapHandler
{
    /**
     * Handle snmptrap.
     * Data is pre-parsed and delivered as a Trap.
     *
     * @param  Device  $device
     * @param  Trap  $trap
     * @return void
     */
    public function handle(Device $device, Trap $trap)
    {
        $initiator_name = $trap->getOidData('VEEAM-MIB::initiatorName');
        $vm_name = $trap->getOidData('VEEAM-MIB::vmName');
        $target_dir = $trap->getOidData('VEEAM-MIB::targetDir');

        $trap->log('SNMP Trap: FLR job started - ' . $vm_name . ' - ' . $initiator_name . ' - ' . $target_dir, Severity::Info, 'backup');
    }
}
