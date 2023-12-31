<?php

echo '
<form class="form-horizontal">
    ' . csrf_field() . '
    <div class="form-group">
        <label for="icmp" class="col-sm-4 control-label">Disable ICMP Test?</label>
        <div class="col-sm-8">
            ' . dynamic_override_config('checkbox', 'override_icmp_disable', $device) . '
        </div>
    </div>
    <div class="form-group">
        <label for="oxidized" class="col-sm-4 control-label">Exclude from Oxidized?</label>
        <div class="col-sm-8">
            ' . dynamic_override_config('checkbox', 'override_Oxidized_disable', $device) . '
        </div>
    </div>
    <div class="form-group">
        <label for="override_ssh" class="col-sm-4 control-label">Override default ssh port</label>
        <div class="col-sm-8">
            ' . dynamic_override_config('text', 'override_device_ssh_port', $device) . '
        </div>
    </div>
    <div class="form-group">
        <label for="override_telnet" class="col-sm-4 control-label">Override default telnet port</label>
        <div class="col-sm-8">
            ' . dynamic_override_config('text', 'override_device_telnet_port', $device) . '
        </div>
    </div>
    <div class="form-group">
        <label for="override_http" class="col-sm-4 control-label">Override default http port</label>
        <div class="col-sm-8">
            ' . dynamic_override_config('text', 'override_device_http_port', $device) . '
        </div>
    </div>
    <div class="form-group">
        <label for="unixagent" class="col-sm-4 control-label">Unix agent port</label>
        <div class="col-sm-8">
            ' . dynamic_override_config('text', 'override_Unixagent_port', $device) . '
        </div>
    </div>
    <div class="form-group">
        <label for="rrdtool_tune" class="col-sm-4 control-label">Enable RRD Tune for all ports?</label>
        <div class="col-sm-8">
            ' . dynamic_override_config('checkbox', 'override_rrdtool_tune', $device) . '
        </div>
    </div>
    <div class="form-group">
        <label for="selected_ports" class="col-sm-4 control-label">Enable selected port polling?</label>
        <div class="col-sm-8">
            ' . dynamic_override_config('checkbox', 'selected_ports', $device) . '
        </div>
    </div>
</form>
';
