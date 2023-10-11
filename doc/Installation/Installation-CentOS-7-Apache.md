> NOTE: These instructions assume you are the **root** user.  If you
> are not, prepend `sudo` to the shell commands (the ones that aren't
> at `mysql>` prompts) or temporarily become a user with root
> privileges with `sudo -s` or `sudo -i`.

!!! warning

    Please note the minimum supported PHP version is @= php.version_min =@.  
    The guide below might not have been updated to reflect it!


## Install Common Required Packages ##

```
yum install epel-release
```

```
yum install git cronie fping jwhois ImageMagick mtr MySQL-python net-snmp net-snmp-utils nmap python-memcached rrdtool policycoreutils-python httpd mariadb mariadb-server unzip python3 python3-pip
```

### Install PHP

CentOS 7 comes with php 5.4 which is not compatible with KartsNMS.
There are multiple ways to install php 7.x on CentOS 7, like Webtatic, Remi or SCL, the last two are maintained by Remi Collet of RedHat.

#### Running with Remi PHP

```
yum localinstall http://rpms.remirepo.net/enterprise/remi-release-7.rpm
```
Install the yum-config-manager to change to Remi PHP 7.3 Repo.
```
yum install yum-utils
yum-config-manager --enable remi-php73
```
Install the required packages

```
yum install mod_php php-cli php-common php-curl php-gd php-mbstring php-process php-snmp php-xml php-zip php-memcached php-mysqlnd
```

#### Running with CentOS SCL php

```
yum install centos-release-scl
```

```
yum install rh-php72 rh-php72-php-cli rh-php72-php-common rh-php72-php-curl rh-php72-php-gd rh-php72-php-mbstring rh-php72-php-process rh-php72-php-snmp rh-php72-php-xml rh-php72-php-zip rh-php72-php-memcached rh-php72-php-mysqlnd
```

```
ln -s /opt/rh/rh-php72/root/usr/bin/php /usr/bin/php
ln -s /opt/rh/httpd24/root/etc/httpd/conf.d/rh-php72-php.conf /etc/httpd/conf.d/
ln -s /opt/rh/httpd24/root/etc/httpd/conf.modules.d/15-rh-php72-php.conf /etc/httpd/conf.modules.d/
ln -s /opt/rh/httpd24/root/etc/httpd/modules/librh-php72-php7.so /etc/httpd/modules/
```

# Add kartsnms user

```
useradd kartsnms -d /opt/kartsnms -M -r
usermod -a -G kartsnms apache
```

# Download KartsNMS

```
cd /opt
git clone https://github.com/kartsnms/kartsnms.git
```

# Set permissions

```
chown -R kartsnms:kartsnms /opt/kartsnms
chmod 770 /opt/kartsnms
setfacl -d -m g::rwx /opt/kartsnms/rrd /opt/kartsnms/logs /opt/kartsnms/bootstrap/cache/ /opt/kartsnms/storage/ /opt/kartsnms/cache
setfacl -R -m g::rwx /opt/kartsnms/rrd /opt/kartsnms/logs /opt/kartsnms/bootstrap/cache/ /opt/kartsnms/storage/ /opt/kartsnms/cache
```

# Install PHP dependencies

```
su - kartsnms
./scripts/composer_wrapper.php install --no-dev
exit
```

# DB Server

## Configure MySQL

```
systemctl enable --now mariadb
mysql -u root
```

> NOTE: Please change the 'password' below to something secure.

```sql
CREATE DATABASE kartsnms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'kartsnms'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON kartsnms.* TO 'kartsnms'@'localhost';
FLUSH PRIVILEGES;
exit
```

```
vi /etc/my.cnf
```

Within the `[mysqld]` section please add:

```bash
innodb_file_per_table=1
lower_case_table_names=0
```

```
systemctl restart mariadb
```

# Web Server

## Configure PHP

Ensure date.timezone is set in php.ini to your preferred time zone.
See <https://php.net/manual/en/timezones.php> for a list of supported
timezones.  Valid examples are: "America/New_York",
"Australia/Brisbane", "Etc/UTC".

When PHP is configured with open_basedir, be sure to allow the following paths for KartsNMS to work:

```
php_admin_value[open_basedir] = "/opt/kartsnms:/usr/lib64/nagios/plugins:/dev/urandom:/usr/sbin/fping:/usr/sbin/fping6:/usr/bin/snmpgetnext:/usr/bin/rrdtool:/usr/bin/snmpwalk:/usr/bin/snmpget:/usr/bin/snmpbulkwalk:/usr/bin/snmptranslate:/usr/bin/traceroute:/usr/bin/whois:/bin/ping:/usr/sbin/mtr:/usr/bin/nmap:/usr/sbin/ipmitool:/usr/bin/virsh:/usr/bin/nfdump"
```

```
vi  /etc/php.ini
```

or

```
vi /etc/opt/rh/rh-php72/php.ini
```



## Configure Apache

Create the kartsnms.conf:

```
vi /etc/httpd/conf.d/kartsnms.conf
```

Add the following config, edit `ServerName` as required:

```apache
<VirtualHost *:80>
  DocumentRoot /opt/kartsnms/html/
  ServerName  kartsnms.example.com

  AllowEncodedSlashes NoDecode
  <Directory "/opt/kartsnms/html/">
    Require all granted
    AllowOverride All
    Options FollowSymLinks MultiViews
  </Directory>
</VirtualHost>
```

> NOTE: If this is the only site you are hosting on this server (it
> should be :)) then you will need to disable the default site. `rm -f /etc/httpd/conf.d/welcome.conf`

```
systemctl enable --now httpd
```

# SELinux

Install the policy tool for SELinux:

```
yum install policycoreutils-python
```

## Configure the contexts needed by KartsNMS

```
semanage fcontext -a -t httpd_sys_content_t '/opt/kartsnms/logs(/.*)?'
semanage fcontext -a -t httpd_sys_rw_content_t '/opt/kartsnms/logs(/.*)?'
restorecon -RFvv /opt/kartsnms/logs/
semanage fcontext -a -t httpd_sys_content_t '/opt/kartsnms/rrd(/.*)?'
semanage fcontext -a -t httpd_sys_rw_content_t '/opt/kartsnms/rrd(/.*)?'
restorecon -RFvv /opt/kartsnms/rrd/
semanage fcontext -a -t httpd_sys_content_t '/opt/kartsnms/storage(/.*)?'
semanage fcontext -a -t httpd_sys_rw_content_t '/opt/kartsnms/storage(/.*)?'
restorecon -RFvv /opt/kartsnms/storage/
semanage fcontext -a -t httpd_sys_content_t '/opt/kartsnms/bootstrap/cache(/.*)?'
semanage fcontext -a -t httpd_sys_rw_content_t '/opt/kartsnms/bootstrap/cache(/.*)?'
restorecon -RFvv /opt/kartsnms/bootstrap/cache/
semanage fcontext -a -t httpd_sys_content_t '/opt/kartsnms/cache(/.*)?'
semanage fcontext -a -t httpd_sys_rw_content_t '/opt/kartsnms/cache(/.*)?'
restorecon -RFvv /var/www/opt/kartsnms/cache/
setsebool -P httpd_can_sendmail=1
```

Additional SELinux problems may be found by executing the following command

```
audit2why < /var/log/audit/audit.log
```

# Allow fping

Create the file http_fping.tt with the following contents. You can
create this file anywhere, as it is a throw-away file. The last step
in this install procedure will install the module in the proper
location.

```
module http_fping 1.0;

require {
type httpd_t;
class capability net_raw;
class rawip_socket { getopt create setopt write read };
}

#============= httpd_t ==============
allow httpd_t self:capability net_raw;
allow httpd_t self:rawip_socket { getopt create setopt write read };
```

Then run these commands

```
checkmodule -M -m -o http_fping.mod http_fping.tt
semodule_package -o http_fping.pp -m http_fping.mod
semodule -i http_fping.pp
```

# Allow access through firewall

```
firewall-cmd --zone public --add-service http
firewall-cmd --permanent --zone public --add-service http
firewall-cmd --zone public --add-service https
firewall-cmd --permanent --zone public --add-service https
```

# Configure snmpd

Copy the example snmpd.conf from the KartsNMS install.

```
cp /opt/kartsnms/snmpd.conf.example /etc/snmp/snmpd.conf
```

```
vi /etc/snmp/snmpd.conf
```

Edit the text which says `RANDOMSTRINGGOESHERE` and set your own community string.

```
curl -o /usr/bin/distro https://raw.githubusercontent.com/kartsnms/kartsnms-agent/master/snmp/distro
chmod +x /usr/bin/distro
systemctl enable snmpd
systemctl restart snmpd
```

# Cron job

```
cp /opt/kartsnms/dist/kartsnms.cron /etc/cron.d/kartsnms
```

> NOTE: Keep in mind  that cron, by default, only uses a very limited
> set of environment variables. You may need to configure proxy
> variables for the cron invocation. Alternatively adding the proxy
> settings in config.php is possible too. The config.php file will be
> created in the upcoming steps. Review the following URL after you
> finished kartsnms install steps:
> <@= config.site_url =@/Support/Configuration/#proxy-support>

# Copy logrotate config

KartsNMS keeps logs in `/opt/kartsnms/logs`. Over time these can
become large and be rotated out.  To rotate out the old logs you can
use the provided logrotate config file:

```
cp /opt/kartsnms/misc/kartsnms.logrotate /etc/logrotate.d/kartsnms
```

# Web installer

Now head to the web installer and follow the on-screen instructions.

<http://kartsnms.example.com/install.php>

The web installer might prompt you to create a `config.php` file in
your kartsnms install location manually, copying the content displayed
on-screen to the file. If you have to do this, please remember to set
the permissions on config.php after you copied the on-screen contents
to the file. Run:

```
chown kartsnms:kartsnms /opt/kartsnms/config.php
```

# Final steps

That's it!  You now should be able to log in to
<http://kartsnms.example.com/>.  Please note that we have not covered
HTTPS setup in this example, so your KartsNMS install is not secure by
default.  Please do not expose it to the public Internet unless you
have configured HTTPS and taken appropriate web server hardening
steps.

# Add the first device

We now suggest that you add localhost as your first device from within the WebUI.

# Troubleshooting

If you ever have issues with your install, run validate.php as root in
the kartsnms directory:

```
cd /opt/kartsnms
./validate.php
```

There are various options for getting help listed on the KartsNMS web
site: <https://www.itkarts.com/#support>

# What next?

Now that you've installed KartsNMS, we'd suggest that you have a read
of a few other docs to get you going:

- [Performance tuning](../Support/Performance.md)
- [Alerting](../Alerting/index.md)
- [Device Groups](../Extensions/Device-Groups.md)
- [Auto discovery](../Extensions/Auto-Discovery.md)

# Closing

We hope you enjoy using KartsNMS. If you do, it would be great if you
would consider opting into the stats system we have, please see [this
page](../General/Callback-Stats-and-Privacy.md) on
what it is and how to enable it.

If you would like to help make KartsNMS better there are [many ways to
help](../Support/FAQ.md#a-namefaq9-what-can-i-do-to-helpa). You
can also [back KartsNMS on Open Collective](https://t.kartsn.ms/donations).
