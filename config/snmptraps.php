<?php

/*
| !!!! DO NOT EDIT THIS FILE !!!!
|
| You can change settings by setting them in the environment or .env
| If there is something you need to change, but is not available as an environment setting,
| request an environment variable to be created upstream or send a pull request.
 */

return [
    'trap_handlers' => [
        'ALCATEL-IND1-VLAN-STP-MIB::stpNewRoot' => \KartsNMS\Snmptrap\Handlers\Aos7stpNewRoot::class,
        'ALCATEL-IND1-VLAN-STP-MIB::stpRootPortChange' => \KartsNMS\Snmptrap\Handlers\Aos7stpRootPortChange::class,
        'ALCATEL-IND1-PORT-MIB::portViolationTrap' => \KartsNMS\Snmptrap\Handlers\Aos7portViolation::class,
        'ALCATEL-IND1-PORT-MIB::portViolationNotificationTrap' => \KartsNMS\Snmptrap\Handlers\Aos7portViolationNotification::class,
        'ALCATEL-IND1-CONFIG-MGR-MIB::alcatelIND1ConfigMgrMIB.3.0.1' => \KartsNMS\Snmptrap\Handlers\Aos6CfgSavedTrap::class,
        'ALCATEL-IND1-CHASSIS-MIB::chassisTrapsAlert' => \KartsNMS\Snmptrap\Handlers\AlechassisTrapsAlert::class,
        'ALCATEL-IND1-STACK-MANAGER-MIB::alaStackMgrDuplicateSlotTrap' => \KartsNMS\Snmptrap\Handlers\Aos6StackMgrDuplicateSlot::class,
        'ALCATEL-IND1-STACK-MANAGER-MIB::alaStackMgrRoleChangeTrap' => \KartsNMS\Snmptrap\Handlers\Aos6StackMgrRoleChange::class,
        'ALCATEL-IND1-IP-MIB::alaDoSTrap' => \KartsNMS\Snmptrap\Handlers\Aos6DoSTrap::class,
        'ALCATEL-IND1-LBD-MIB::alaLbdStateChangeToShutdown' => \KartsNMS\Snmptrap\Handlers\Aos6LbdStateChangeToShutdown::class,
        'ALCATEL-IND1-LBD-MIB::alaLbdStateChangeForAutoRecovery' => \KartsNMS\Snmptrap\Handlers\Aos6LbdStateChangeForAutoRecovery::class,
        'ALCATEL-IND1-AAA-MIB::aaaHicServerTrap' => \KartsNMS\Snmptrap\Handlers\Aos6HicServerTrap::class,
        'BGP4-MIB::bgpBackwardTransition' => \KartsNMS\Snmptrap\Handlers\BgpBackwardTransition::class,
        'BGP4-MIB::bgpEstablished' => \KartsNMS\Snmptrap\Handlers\BgpEstablished::class,
        'BGP4-V2-MIB-JUNIPER::jnxBgpM2BackwardTransition' => \KartsNMS\Snmptrap\Handlers\JnxBgpM2BackwardTransition::class,
        'BGP4-V2-MIB-JUNIPER::jnxBgpM2Established' => \KartsNMS\Snmptrap\Handlers\JnxBgpM2Established::class,
        'BRIDGE-MIB::newRoot' => \KartsNMS\Snmptrap\Handlers\BridgeNewRoot::class,
        'BRIDGE-MIB::topologyChange' => \KartsNMS\Snmptrap\Handlers\BridgeTopologyChanged::class,
        'CISCO-PORT-SECURITY-MIB::cpsSecureMacAddrViolation' => \KartsNMS\Snmptrap\Handlers\CiscoMacViolation::class,
        'CISCO-ERR-DISABLE-MIB::cErrDisableInterfaceEventRev1' => \KartsNMS\Snmptrap\Handlers\CiscoErrDisableInterfaceEvent::class,
        'CISCO-IETF-DHCP-SERVER-MIB::cDhcpv4ServerStartTime' => \KartsNMS\Snmptrap\Handlers\CiscoDHCPServerStart::class,
        'CISCO-IETF-DHCP-SERVER-MIB::cDhcpv4ServerStopTime' => \KartsNMS\Snmptrap\Handlers\CiscoDHCPServerStop::class,
        'CISCO-IETF-DHCP-SERVER-MIB::cDhcpv4ServerFreeAddressLow' => \KartsNMS\Snmptrap\Handlers\CiscoDHCPServerFreeAddressLow::class,
        'CISCO-IETF-DHCP-SERVER-MIB::cDhcpv4ServerFreeAddressHigh' => \KartsNMS\Snmptrap\Handlers\CiscoDHCPServerFreeAddressHigh::class,
        'CM-ALARM-MIB::cmNetworkElementAlmTrap' => \KartsNMS\Snmptrap\Handlers\AdvaNetworkElementAlmTrap::class,
        'CM-ALARM-MIB::cmSysAlmTrap' => \KartsNMS\Snmptrap\Handlers\AdvaSysAlmTrap::class,
        'CM-PERFORMANCE-MIB::cmEthernetAccPortThresholdCrossingAlert' => \KartsNMS\Snmptrap\Handlers\AdvaAccThresholdCrossingAlert::class,
        'CM-PERFORMANCE-MIB::cmEthernetNetPortThresholdCrossingAlert' => \KartsNMS\Snmptrap\Handlers\AdvaNetThresholdCrossingAlert::class,
        'CM-SYSTEM-MIB::cmAttributeValueChangeTrap' => \KartsNMS\Snmptrap\Handlers\AdvaAttributeChange::class,
        'CM-SYSTEM-MIB::cmObjectCreationTrap' => \KartsNMS\Snmptrap\Handlers\AdvaObjectCreation::class,
        'CM-SYSTEM-MIB::cmObjectDeletionTrap' => \KartsNMS\Snmptrap\Handlers\AdvaObjectDeletion::class,
        'CM-SYSTEM-MIB::cmSnmpDyingGaspTrap' => \KartsNMS\Snmptrap\Handlers\AdvaSnmpDyingGaspTrap::class,
        'CM-SYSTEM-MIB::cmStateChangeTrap' => \KartsNMS\Snmptrap\Handlers\AdvaStateChangeTrap::class,
        'CPS-MIB::lowBattery' => KartsNMS\Snmptrap\Handlers\CpLowBattery::class,
        'CPS-MIB::powerRestored' => \KartsNMS\Snmptrap\Handlers\CpPowerRestored::class,
        'CPS-MIB::returnFromChargerFailure' => \KartsNMS\Snmptrap\Handlers\CpUpsRtnChargerFailure::class,
        'CPS-MIB::returnFromLowBattery' => \KartsNMS\Snmptrap\Handlers\CpRtnLowBattery::class,
        'CPS-MIB::upsDiagnosticsFailed' => \KartsNMS\Snmptrap\Handlers\CpUpsDiagFailed::class,
        'CPS-MIB::returnFromDischarged' => \KartsNMS\Snmptrap\Handlers\CpRtnDischarge::class,
        'CPS-MIB::returnFromOverLoad' => \KartsNMS\Snmptrap\Handlers\CpUpsRtnOverload::class,
        'CPS-MIB::returnFromOverTemp' => \KartsNMS\Snmptrap\Handlers\CpUpsRtnOverTemp::class,
        'CPS-MIB::upsBatteryNotPresent' => \KartsNMS\Snmptrap\Handlers\CpUpsBatteryNotPresent::class,
        'CPS-MIB::upsChargerFailure' => \KartsNMS\Snmptrap\Handlers\CpUpsChargerFailure::class,
        'CPS-MIB::upsDiagnosticsPassed' => \KartsNMS\Snmptrap\Handlers\CpUpsDiagPassed::class,
        'CPS-MIB::upsDischarged' => \KartsNMS\Snmptrap\Handlers\CpUpsDischarged::class,
        'CPS-MIB::upsOnBattery' => \KartsNMS\Snmptrap\Handlers\CpUpsOnBattery::class,
        'CPS-MIB::upsOverload' => \KartsNMS\Snmptrap\Handlers\CpUpsOverload::class,
        'CPS-MIB::upsOverTemp' => \KartsNMS\Snmptrap\Handlers\CpUpsOverTemp::class,
        'CPS-MIB::upsRebootStarted' => \KartsNMS\Snmptrap\Handlers\CpUpsRebootStarted::class,
        'CPS-MIB::upsSleeping' => \KartsNMS\Snmptrap\Handlers\CpUpsSleeping::class,
        'CPS-MIB::upsStartBatteryTest' => \KartsNMS\Snmptrap\Handlers\CpUpsStartBatteryTest::class,
        'CPS-MIB::upsTurnedOff' => \KartsNMS\Snmptrap\Handlers\CpUpsTurnedOff::class,
        'CPS-MIB::upsWokeUp' => \KartsNMS\Snmptrap\Handlers\CpUpsWokeUp::class,
        'EKINOPS-MGNT2-NMS-MIB::mgnt2TrapNMSEvent' => \KartsNMS\Snmptrap\Handlers\Mgnt2TrapNmsEvent::class,
        'EKINOPS-MGNT2-NMS-MIB::mgnt2TrapNMSAlarm' => \KartsNMS\Snmptrap\Handlers\Mgnt2TrapNmsAlarm::class,
        'ENTITY-MIB::entConfigChange' => \KartsNMS\Snmptrap\Handlers\EntityDatabaseConfigChanged::class,
        'EQUIPMENT-MIB::equipStatusTrap' => \KartsNMS\Snmptrap\Handlers\EquipStatusTrap::class,
        'FORTINET-FORTIGATE-MIB::fgTrapAvOversize' => \KartsNMS\Snmptrap\Handlers\FgTrapAvOversize::class,
        'FORTINET-FORTIGATE-MIB::fgTrapIpsAnomaly' => \KartsNMS\Snmptrap\Handlers\FgTrapIpsAnomaly::class,
        'FORTINET-FORTIGATE-MIB::fgTrapIpsPkgUpdate' => \KartsNMS\Snmptrap\Handlers\FgTrapIpsPkgUpdate::class,
        'FORTINET-FORTIGATE-MIB::fgTrapIpsSignature' => \KartsNMS\Snmptrap\Handlers\FgTrapIpsSignature::class,
        'FORTINET-FORTIGATE-MIB::fgTrapVpnTunDown' => \KartsNMS\Snmptrap\Handlers\FgTrapVpnTunDown::class,
        'FORTINET-FORTIGATE-MIB::fgTrapVpnTunUp' => \KartsNMS\Snmptrap\Handlers\FgTrapVpnTunUp::class,
        'FORTINET-FORTIMANAGER-FORTIANALYZER-MIB::fmTrapLogRateThreshold' => \KartsNMS\Snmptrap\Handlers\FmTrapLogRateThreshold::class,
        'FOUNDRY-SN-TRAP-MIB::snTrapUserLogin' => \KartsNMS\Snmptrap\Handlers\SnTrapUserLogin::class,
        'FOUNDRY-SN-TRAP-MIB::snTrapUserLogout' => \KartsNMS\Snmptrap\Handlers\SnTrapUserLogout::class,
        'IF-MIB::linkDown' => \KartsNMS\Snmptrap\Handlers\LinkDown::class,
        'IF-MIB::linkUp' => \KartsNMS\Snmptrap\Handlers\LinkUp::class,
        'JUNIPER-CFGMGMT-MIB::jnxCmCfgChange' => \KartsNMS\Snmptrap\Handlers\JnxCmCfgChange::class,
        'JUNIPER-DOM-MIB::jnxDomAlarmCleared' => \KartsNMS\Snmptrap\Handlers\JnxDomAlarmCleared::class,
        'JUNIPER-DOM-MIB::jnxDomAlarmSet' => \KartsNMS\Snmptrap\Handlers\JnxDomAlarmSet::class,
        'JUNIPER-DOM-MIB::jnxDomLaneAlarmCleared' => \KartsNMS\Snmptrap\Handlers\JnxDomLaneAlarmCleared::class,
        'JUNIPER-DOM-MIB::jnxDomLaneAlarmSet' => \KartsNMS\Snmptrap\Handlers\JnxDomLaneAlarmSet::class,
        'JUNIPER-LDP-MIB::jnxLdpLspDown' => \KartsNMS\Snmptrap\Handlers\JnxLdpLspDown::class,
        'JUNIPER-LDP-MIB::jnxLdpLspUp' => \KartsNMS\Snmptrap\Handlers\JnxLdpLspUp::class,
        'JUNIPER-LDP-MIB::jnxLdpSesDown' => \KartsNMS\Snmptrap\Handlers\JnxLdpSesDown::class,
        'JUNIPER-LDP-MIB::jnxLdpSesUp' => \KartsNMS\Snmptrap\Handlers\JnxLdpSesUp::class,
        'JUNIPER-MIB::jnxPowerSupplyFailure' => \KartsNMS\Snmptrap\Handlers\JnxPowerSupplyFailure::class,
        'JUNIPER-MIB::jnxPowerSupplyOK' => \KartsNMS\Snmptrap\Handlers\JnxPowerSupplyOk::class,
        'JUNIPER-VPN-MIB::jnxVpnIfDown' => \KartsNMS\Snmptrap\Handlers\JnxVpnIfDown::class,
        'JUNIPER-VPN-MIB::jnxVpnIfUp' => \KartsNMS\Snmptrap\Handlers\JnxVpnIfUp::class,
        'JUNIPER-VPN-MIB::jnxVpnPwDown' => \KartsNMS\Snmptrap\Handlers\JnxVpnPwDown::class,
        'JUNIPER-VPN-MIB::jnxVpnPwUp' => \KartsNMS\Snmptrap\Handlers\JnxVpnPwUp::class,
        'LOG-MIB::logTrap' => \KartsNMS\Snmptrap\Handlers\LogTrap::class,
        'MG-SNMP-UPS-MIB::upsmgUtilityFailure' => \KartsNMS\Snmptrap\Handlers\UpsmgUtilityFailure::class,
        'MG-SNMP-UPS-MIB::upsmgUtilityRestored' => \KartsNMS\Snmptrap\Handlers\UpsmgUtilityRestored::class,
        'NETGEAR-SMART-SWITCHING-MIB::failedUserLoginTrap' => \KartsNMS\Snmptrap\Handlers\FailedUserLogin::class,
        'NETGEAR-SWITCHING-MIB::failedUserLoginTrap' => \KartsNMS\Snmptrap\Handlers\FailedUserLogin::class,
        'PowerNet-MIB::outletOff' => \KartsNMS\Snmptrap\Handlers\ApcPduOutletOff::class,
        'PowerNet-MIB::outletOn' => \KartsNMS\Snmptrap\Handlers\ApcPduOutletOn::class,
        'PowerNet-MIB::outletReboot' => \KartsNMS\Snmptrap\Handlers\ApcPduOutletReboot::class,
        'PowerNet-MIB::rPDUNearOverload' => \KartsNMS\Snmptrap\Handlers\ApcPduNearOverload::class,
        'PowerNet-MIB::rPDUNearOverloadCleared' => \KartsNMS\Snmptrap\Handlers\ApcPduNearOverloadCleared::class,
        'PowerNet-MIB::rPDUOverload' => \KartsNMS\Snmptrap\Handlers\ApcPduOverload::class,
        'PowerNet-MIB::rPDUOverloadCleared' => \KartsNMS\Snmptrap\Handlers\ApcPduOverloadCleared::class,
        'PowerNet-MIB::upsOnBattery' => \KartsNMS\Snmptrap\Handlers\ApcOnBattery::class,
        'PowerNet-MIB::powerRestored' => \KartsNMS\Snmptrap\Handlers\ApcPowerRestored::class,
        'PowerNet-MIB::smartAvrReducing' => \KartsNMS\Snmptrap\Handlers\ApcSmartAvrReducing::class,
        'PowerNet-MIB::smartAvrReducingOff' => \KartsNMS\Snmptrap\Handlers\ApcSmartAvrReducingOff::class,
        'RUCKUS-EVENT-MIB::ruckusEventAssocTrap' => \KartsNMS\Snmptrap\Handlers\RuckusAssocTrap::class,
        'RUCKUS-EVENT-MIB::ruckusEventDiassocTrap' => \KartsNMS\Snmptrap\Handlers\RuckusDiassocTrap::class,
        'RUCKUS-EVENT-MIB::ruckusEventSetErrorTrap' => \KartsNMS\Snmptrap\Handlers\RuckusSetError::class,
        'RUCKUS-SZ-EVENT-MIB::ruckusSZAPMiscEventTrap' => \KartsNMS\Snmptrap\Handlers\RuckusSzApMiscEvent::class,
        'RUCKUS-SZ-EVENT-MIB::ruckusSZAPConfUpdatedTrap' => \KartsNMS\Snmptrap\Handlers\RuckusSzApConf::class,
        'RUCKUS-SZ-EVENT-MIB::ruckusSZAPRebootTrap' => \KartsNMS\Snmptrap\Handlers\RuckusSzApReboot::class,
        'RUCKUS-SZ-EVENT-MIB::ruckusSZAPConnectedTrap' => \KartsNMS\Snmptrap\Handlers\RuckusSzApConnect::class,
        'RUCKUS-SZ-EVENT-MIB::ruckusSZClusterInMaintenanceStateTrap' => \KartsNMS\Snmptrap\Handlers\RuckusSzClusterInMaintenance::class,
        'RUCKUS-SZ-EVENT-MIB::ruckusSZClusterBackToInServiceTrap' => \KartsNMS\Snmptrap\Handlers\RuckusSzClusterInService::class,
        'SNMPv2-MIB::authenticationFailure' => \KartsNMS\Snmptrap\Handlers\AuthenticationFailure::class,
        'SNMPv2-MIB::coldStart' => \KartsNMS\Snmptrap\Handlers\ColdBoot::class,
        'SNMPv2-MIB::warmStart' => \KartsNMS\Snmptrap\Handlers\WarmBoot::class,
        'TRIPPLITE-PRODUCTS::tlpNotificationsAlarmEntryAdded' => \KartsNMS\Snmptrap\Handlers\TrippliteAlarmAdded::class,
        'TRIPPLITE-PRODUCTS::tlpNotificationsAlarmEntryRemoved' => \KartsNMS\Snmptrap\Handlers\TrippliteAlarmRemoved::class,
        'VMWARE-VMINFO-MIB::vmwVmHBDetected' => \KartsNMS\Snmptrap\Handlers\VmwVmHBDetected::class,
        'VMWARE-VMINFO-MIB::vmwVmHBLost' => \KartsNMS\Snmptrap\Handlers\VmwVmHBLost::class,
        'VMWARE-VMINFO-MIB::vmwVmPoweredOn' => \KartsNMS\Snmptrap\Handlers\VmwVmPoweredOn::class,
        'VMWARE-VMINFO-MIB::vmwVmPoweredOff' => \KartsNMS\Snmptrap\Handlers\VmwVmPoweredOff::class,
        'VMWARE-VMINFO-MIB::vmwVmSuspended' => \KartsNMS\Snmptrap\Handlers\VmwVmSuspended::class,
        'OSPF-TRAP-MIB::ospfIfStateChange' => \KartsNMS\Snmptrap\Handlers\OspfIfStateChange::class,
        'OSPF-TRAP-MIB::ospfNbrStateChange' => \KartsNMS\Snmptrap\Handlers\OspfNbrStateChange::class,
        'OSPF-TRAP-MIB::ospfTxRetransmit' => \KartsNMS\Snmptrap\Handlers\OspfTxRetransmit::class,
        'UPS-MIB::upsTrapOnBattery' => \KartsNMS\Snmptrap\Handlers\UpsTrapOnBattery::class,
        'UPS-MIB::upsTraps.0.1' => \KartsNMS\Snmptrap\Handlers\UpsTrapOnBattery::class, // apparently bad/old UPS-MIB
        'VEEAM-MIB::onBackupJobCompleted' => \KartsNMS\Snmptrap\Handlers\VeeamBackupJobCompleted::class,
        'VEEAM-MIB::onVmBackupCompleted' => \KartsNMS\Snmptrap\Handlers\VeeamVmBackupCompleted::class,
        'VEEAM-MIB::onLinuxFLRMountStarted' => \KartsNMS\Snmptrap\Handlers\VeeamLinuxFLRMountStarted::class,
        'VEEAM-MIB::onLinuxFLRCopyToStarted' => \KartsNMS\Snmptrap\Handlers\VeeamLinuxFLRCopyToStarted::class,
        'VEEAM-MIB::onLinuxFLRToOriginalStarted' => \KartsNMS\Snmptrap\Handlers\VeeamLinuxFLRToOriginalStarted::class,
        'VEEAM-MIB::onLinuxFLRCopyToFinished' => \KartsNMS\Snmptrap\Handlers\VeeamLinuxFLRCopyToFinished::class,
        'VEEAM-MIB::onLinuxFLRToOriginalFinished' => \KartsNMS\Snmptrap\Handlers\VeeamLinuxFLRToOriginalFinished::class,
        'VEEAM-MIB::onWinFLRMountStarted' => \KartsNMS\Snmptrap\Handlers\VeeamWinFLRMountStarted::class,
        'VEEAM-MIB::onWinFLRToOriginalStarted' => \KartsNMS\Snmptrap\Handlers\VeeamWinFLRToOriginalStarted::class,
        'VEEAM-MIB::onWinFLRCopyToStarted' => \KartsNMS\Snmptrap\Handlers\VeeamWinFLRCopyToStarted::class,
        'VEEAM-MIB::onWinFLRToOriginalFinished' => \KartsNMS\Snmptrap\Handlers\VeeamWinFLRToOriginalFinished::class,
        'VEEAM-MIB::onWinFLRCopyToFinished' => \KartsNMS\Snmptrap\Handlers\VeeamWinFLRCopyToFinished::class,
        'VEEAM-MIB::onWebDownloadStart' => \KartsNMS\Snmptrap\Handlers\VeeamWebDownloadStart::class,
        'VEEAM-MIB::onWebDownloadFinished' => \KartsNMS\Snmptrap\Handlers\VeeamWebDownloadFinished::class,
        'VEEAM-MIB::onSobrOffloadFinished' => \KartsNMS\Snmptrap\Handlers\VeeamSobrOffloadFinished::class,
        'VEEAM-MIB::onCdpRpoReport' => \KartsNMS\Snmptrap\Handlers\VeeamCdpRpoReport::class,
        'HP-ICF-FAULT-FINDER-MIB::hpicfFaultFinderTrap' => \KartsNMS\Snmptrap\Handlers\HpFault::class,
    ],
];
