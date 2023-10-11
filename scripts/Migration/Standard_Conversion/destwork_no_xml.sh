#!/usr/bin/env bash
# Observium to KartsNMS conversion

####################### SCRIPT DESCRIPTION ########################
# A simple script to add each host in text file to KartsNMS       #
###################################################################

########################### DIRECTIONS ############################
# Enter values for ADDHOST, SNMPSTRING, and NODELIST. The default #
# should work if you put the files in the same location.          #
###################################################################

############################# CREDITS #############################
# KartsNMS work is done by a great group - https://www.itkarts.com    #
# Script Written by - Dan Brown - http://vlan50.com               #
###################################################################

# Enter path to KartsNMS addhost module
ADDHOST=/opt/kartsnms/addhost.php
# Enter your unique SNMP String
SNMPSTRING=cisconetwork
# Enter SNMP version of all clients in nodelist text file
SNMPVERSION=v2c
# Enter path to nodelist text file
NODELIST=/tmp/nodelist.txt
# Enter user and group of KartsNMS installation
L_USRGRP=kartsnms

while read line
	# Change ownership to KartsNMS user and group
	chown -R $L_USRGRP:$L_USRGRP .;
	# Add each host from the node list file to KartsNMS
	do php $ADDHOST "${line%/*}" $SNMPSTRING $SNMPVERSION;
done < $NODELIST
