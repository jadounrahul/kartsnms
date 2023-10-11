> NOTE: These instructions assume you are the **root** user.  If you
> are not, prepend `sudo` to the shell commands (the ones that aren't
> at `mysql>` prompts) or temporarily become a user with root
> privileges with `sudo -s` or `sudo -i`.

!!! warning

    Please note the minimum supported PHP version is @= php.version_min =@.  
    The guide below might not have been updated to reflect it!

# Install Required Packages

```bash
apt install software-properties-common
add-apt-repository universe
apt update
apt install curl composer fping git graphviz imagemagick mariadb-client mariadb-server mtr-tiny nginx-full nmap php7.2-cli php7.2-curl php7.2-fpm php7.2-gd php7.2-json php7.2-mbstring php7.2-mysql php7.2-snmp php7.2-xml php7.2-zip python-memcache python-mysqldb rrdtool snmp snmpd whois unzip python3-pip
```

# Add kartsnms user

```bash
useradd kartsnms -d /opt/kartsnms -M -r
usermod -a -G kartsnms www-data
```

# Download KartsNMS

```bash
 cd /opt
 git clone https://github.com/kartsnms/kartsnms.git
```

# Set permissions

```bash
chown -R kartsnms:kartsnms /opt/kartsnms
chmod 770 /opt/kartsnms
setfacl -d -m g::rwx /opt/kartsnms/rrd /opt/kartsnms/logs /opt/kartsnms/bootstrap/cache/ /opt/kartsnms/storage/
setfacl -R -m g::rwx /opt/kartsnms/rrd /opt/kartsnms/logs /opt/kartsnms/bootstrap/cache/ /opt/kartsnms/storage/
```

# Install PHP dependencies

```bash
su - kartsnms
cd /opt/kartsnms
./scripts/composer_wrapper.php install --no-dev
exit
```

# DB Server

## Configure MySQL

```bash
systemctl restart mysql
mysql -uroot -p
```

> NOTE: Please change the 'password' below to something secure.

```sql
CREATE DATABASE kartsnms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'kartsnms'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON kartsnms.* TO 'kartsnms'@'localhost';
FLUSH PRIVILEGES;
exit
```

```bash
vi /etc/mysql/mariadb.conf.d/50-server.cnf
```

Within the `[mysqld]` section please add:

```bash
innodb_file_per_table=1
lower_case_table_names=0
```

```bash
systemctl restart mysql
```

# Web Server

## Configure and Start PHP-FPM

Ensure date.timezone is set in php.ini to your preferred time zone.
See <https://php.net/manual/en/timezones.php> for a list of supported
timezones.  Valid examples are: "America/New_York",
"Australia/Brisbane", "Etc/UTC".
Please remember to set the system timezone as well.

```bash
vi /etc/php/7.2/fpm/php.ini
vi /etc/php/7.2/cli/php.ini
```

```bash
systemctl restart php7.2-fpm
´´´

```
timedatectl set-timezone Etc/UTC
´´´

## Configure NGINX

```bash
vi /etc/nginx/conf.d/kartsnms.conf
```

Add the following config, edit `server_name` as required:

```nginx
server {
 listen      80;
 server_name kartsnms.example.com;
 root        /opt/kartsnms/html;
 index       index.php;

 charset utf-8;
 gzip on;
 gzip_types text/css application/javascript text/javascript application/x-javascript image/svg+xml text/plain text/xsd text/xsl text/xml image/x-icon;

 proxy_read_timeout 300;
 proxy_connect_timeout 300;
 proxy_send_timeout 300;

 location / {
  try_files $uri $uri/ /index.php?$query_string;
 }
 location /api/v0 {
  try_files $uri $uri/ /api_v0.php?$query_string;
 }
 location ~ \.php {
  include fastcgi.conf;
  fastcgi_split_path_info ^(.+\.php)(/.+)$;
  fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
 }
 location ~ /\.ht {
  deny all;
 }
}
```

```bash
rm /etc/nginx/sites-enabled/default
systemctl restart nginx
```

# Configure snmpd

```bash
cp /opt/kartsnms/snmpd.conf.example /etc/snmp/snmpd.conf
vi /etc/snmp/snmpd.conf
```

Edit the text which says `RANDOMSTRINGGOESHERE` and set your own community string.

```bash
curl -o /usr/bin/distro https://raw.githubusercontent.com/kartsnms/kartsnms-agent/master/snmp/distro
chmod +x /usr/bin/distro
systemctl restart snmpd
```

# Cron job

```bash
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

```bash
cp /opt/kartsnms/misc/kartsnms.logrotate /etc/logrotate.d/kartsnms
```

# Set permissions

```bash
chown -R kartsnms:kartsnms /opt/kartsnms
setfacl -d -m g::rwx /opt/kartsnms/rrd /opt/kartsnms/logs /opt/kartsnms/bootstrap/cache/ /opt/kartsnms/storage/
setfacl -R -m g::rwx /opt/kartsnms/rrd /opt/kartsnms/logs /opt/kartsnms/bootstrap/cache/ /opt/kartsnms/storage/
```

# Web installer

Now head to the web installer and follow the on-screen instructions.

<http://kartsnms.example.com/install.php>

The web installer might prompt you to create a `config.php` file in
your kartsnms install location manually, copying the content displayed
on-screen to the file. If you have to do this, please remember to set
the permissions on config.php after you copied the on-screen contents
to the file. Run:

```bash
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

We now suggest that you add localhost as your first device from within
the WebUI.

# Troubleshooting

If you ever have issues with your install, run validate.php as root in
the kartsnms directory:

```bash
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
