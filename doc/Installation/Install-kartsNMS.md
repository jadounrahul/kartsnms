# Install KartsNMS

## Prepare Linux Server

You should have an installed Linux server running one of the supported OS.
Make sure you select your server's OS in the tabbed options below.
Choice of web server is your preference, NGINX is recommended.

Connect to the server command line and follow the instructions below.
!!! note

    These instructions assume you are the **root** user.  
    If you are not, prepend `sudo` to the shell commands (the ones that aren't
    at `mysql>` prompts) or temporarily become a user with root
    privileges with `sudo -s` or `sudo -i`.

**Please note the minimum supported PHP version is @= php.version_min =@**

## Install Required Packages

=== "Ubuntu 22.04"
    === "NGINX"
        ```
        apt install acl curl fping git graphviz imagemagick mariadb-client mariadb-server mtr-tiny nginx-full nmap php-cli php-curl php-fpm php-gd php-gmp php-json php-mbstring php-mysql php-snmp php-xml php-zip rrdtool snmp snmpd unzip python3-pymysql python3-dotenv python3-redis python3-setuptools python3-systemd python3-pip whois
        ```

=== "Ubuntu 20.04"
    === "NGINX"
        ```
        apt install software-properties-common
        add-apt-repository universe
        add-apt-repository ppa:ondrej/php
        apt update
        apt install acl curl fping git graphviz imagemagick mariadb-client mariadb-server mtr-tiny nginx-full nmap php-cli php-curl php-fpm php-gd php-gmp php-json php-mbstring php-mysql php-snmp php-xml php-zip rrdtool snmp snmpd unzip python3-pymysql python3-dotenv python3-redis python3-setuptools python3-systemd python3-pip whois
        ```

    === "Apache"
        ```
        apt install software-properties-common
        add-apt-repository universe
        add-apt-repository ppa:ondrej/php
        apt update
        apt install acl curl apache2 fping git graphviz imagemagick libapache2-mod-fcgid mariadb-client mariadb-server mtr-tiny nmap php-cli php-curl php-fpm php-gd php-gmp php-json php-mbstring php-mysql php-snmp php-xml php-zip rrdtool snmp snmpd whois python3-pymysql python3-dotenv python3-redis python3-setuptools python3-systemd python3-pip unzip
        ```

=== "CentOS 8"
    === "NGINX"
        ```
        dnf -y install epel-release
        dnf -y install dnf-utils http://rpms.remirepo.net/enterprise/remi-release-8.rpm
        dnf module reset php
        dnf module enable php:8.1
        dnf install bash-completion cronie fping git ImageMagick mariadb-server mtr net-snmp net-snmp-utils nginx nmap php-fpm php-cli php-common php-curl php-gd php-gmp php-json php-mbstring php-process php-snmp php-xml php-zip php-mysqlnd python3 python3-PyMySQL python3-redis python3-memcached python3-pip python3-systemd rrdtool unzip
        ```

    === "Apache"
        ```
        dnf -y install epel-release
        dnf -y install dnf-utils http://rpms.remirepo.net/enterprise/remi-release-8.rpm
        dnf module reset php
        dnf module enable php:remi-8.1
        dnf install bash-completion cronie fping gcc git httpd ImageMagick mariadb-server mtr net-snmp net-snmp-utils nmap php-fpm php-cli php-common php-curl php-gd php-gmp php-json php-mbstring php-process php-snmp php-xml php-zip php-mysqlnd python3 python3-devel python3-PyMySQL python3-redis python3-memcached python3-pip python3-systemd rrdtool unzip 
        ```

=== "Debian 11"
    === "NGINX"
        ```
        apt install apt-transport-https lsb-release ca-certificates wget
        wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
        echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/sury-php.list
        apt update
        apt install acl curl fping git graphviz imagemagick mariadb-client mariadb-server mtr-tiny nginx-full nmap php-cli php-curl php-fpm php-gd php-gmp php-json php-mbstring php-mysql php-snmp php-xml php-zip python3-dotenv python3-pymysql python3-redis python3-setuptools python3-systemd python3-pip rrdtool snmp snmpd unzip whois
        ```

## Add kartsnms user

```
useradd kartsnms -d /opt/kartsnms -M -r -s "$(which bash)"
```

## Download KartsNMS

```
cd /opt
git clone https://github.com/kartsnms/kartsnms.git
```

## Set permissions

```
chown -R kartsnms:kartsnms /opt/kartsnms
chmod 771 /opt/kartsnms
setfacl -d -m g::rwx /opt/kartsnms/rrd /opt/kartsnms/logs /opt/kartsnms/bootstrap/cache/ /opt/kartsnms/storage/
setfacl -R -m g::rwx /opt/kartsnms/rrd /opt/kartsnms/logs /opt/kartsnms/bootstrap/cache/ /opt/kartsnms/storage/
```

## Install PHP dependencies

```
su - kartsnms
./scripts/composer_wrapper.php install --no-dev
exit
```
Sometimes when there is a proxy used to gain internet access, the above script may fail. The workaround is to install the `composer` package manually. For a global installation:
```
wget https://getcomposer.org/composer-stable.phar
mv composer-stable.phar /usr/bin/composer
chmod +x /usr/bin/composer
```

## Set timezone

See <https://php.net/manual/en/timezones.php> for a list of supported
timezones.  Valid examples are: "America/New_York", "Australia/Brisbane", "Etc/UTC".
Ensure date.timezone is set in php.ini to your preferred time zone.

=== "Ubuntu 22.04"
    ```bash
    vi /etc/php/8.1/fpm/php.ini
    vi /etc/php/8.1/cli/php.ini
    ```

=== "Ubuntu 20.04"
    ```bash
    vi /etc/php/8.1/fpm/php.ini
    vi /etc/php/8.1/cli/php.ini
    ```

=== "CentOS 8"
    ```
    vi /etc/php.ini
    ```

=== "Debian 11"
    ```bash
    vi /etc/php/8.2/fpm/php.ini
    vi /etc/php/8.2/cli/php.ini
    ```

Remember to set the system timezone as well.

```
timedatectl set-timezone Etc/UTC
```


## Configure MariaDB

=== "Ubuntu 22.04"
    ```
    vi /etc/mysql/mariadb.conf.d/50-server.cnf
    ```

=== "Ubuntu 20.04"
    ```
    vi /etc/mysql/mariadb.conf.d/50-server.cnf
    ```

=== "CentOS 8"
    ```
    vi /etc/my.cnf.d/mariadb-server.cnf
    ```

=== "Debian 11"
    ```
    vi /etc/mysql/mariadb.conf.d/50-server.cnf
    ```

Within the `[mysqld]` section add:

```
innodb_file_per_table=1
lower_case_table_names=0
```

Then restart MariaDB

```
systemctl enable mariadb
systemctl restart mariadb
```
Start MariaDB client

```
mysql -u root
```

> NOTE: Change the 'password' below to something secure.

```sql
CREATE DATABASE kartsnms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'kartsnms'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON kartsnms.* TO 'kartsnms'@'localhost';
exit
```

## Configure PHP-FPM

=== "Ubuntu 22.04"
    ```bash
    cp /etc/php/8.1/fpm/pool.d/www.conf /etc/php/8.1/fpm/pool.d/kartsnms.conf
    vi /etc/php/8.1/fpm/pool.d/kartsnms.conf
    ```

=== "Ubuntu 20.04"
    ```bash
    cp /etc/php/8.1/fpm/pool.d/www.conf /etc/php/8.1/fpm/pool.d/kartsnms.conf
    vi /etc/php/8.1/fpm/pool.d/kartsnms.conf
    ```

=== "CentOS 8"
    ```bash
    cp /etc/php-fpm.d/www.conf /etc/php-fpm.d/kartsnms.conf
    vi /etc/php-fpm.d/kartsnms.conf
    ```

=== "Debian 11"
    ```bash
    cp /etc/php/8.2/fpm/pool.d/www.conf /etc/php/8.2/fpm/pool.d/kartsnms.conf
    vi /etc/php/8.2/fpm/pool.d/kartsnms.conf
    ```

Change `[www]` to `[kartsnms]`:
```
[kartsnms]
```

Change `user` and `group` to "kartsnms":
```
user = kartsnms
group = kartsnms
```

Change `listen` to a unique path that must match your webserver's config (`fastcgi_pass` for NGINX and `SetHandler` for Apache) :
```
listen = /run/php-fpm-kartsnms.sock
```

If there are no other PHP web applications on this server, you may remove www.conf to save some resources.
Feel free to tune the performance settings in kartsnms.conf to meet your needs.

## Configure Web Server

=== "Ubuntu 22.04"
    === "NGINX"
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
         location / {
          try_files $uri $uri/ /index.php?$query_string;
         }
         location ~ [^/]\.php(/|$) {
          fastcgi_pass unix:/run/php-fpm-kartsnms.sock;
          fastcgi_split_path_info ^(.+\.php)(/.+)$;
          include fastcgi.conf;
         }
         location ~ /\.(?!well-known).* {
          deny all;
         }
        }
        ```

        ```bash
        rm /etc/nginx/sites-enabled/default
        systemctl restart nginx
        systemctl restart php8.1-fpm
        ```

=== "Ubuntu 20.04"
    === "NGINX"
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
         location / {
          try_files $uri $uri/ /index.php?$query_string;
         }
         location ~ [^/]\.php(/|$) {
          fastcgi_pass unix:/run/php-fpm-kartsnms.sock;
          fastcgi_split_path_info ^(.+\.php)(/.+)$;
          include fastcgi.conf;
         }
         location ~ /\.(?!well-known).* {
          deny all;
         }
        }
        ```

        ```bash
        rm /etc/nginx/sites-enabled/default
        systemctl restart nginx
        systemctl restart php8.1-fpm
        ```

    === "Apache"
        ```bash
        vi /etc/apache2/sites-available/kartsnms.conf
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

          # Enable http authorization headers
          <IfModule setenvif_module>
            SetEnvIfNoCase ^Authorization$ "(.+)" HTTP_AUTHORIZATION=$1
          </IfModule>

          <FilesMatch ".+\.php$">
            SetHandler "proxy:unix:/run/php-fpm-kartsnms.sock|fcgi://localhost"
          </FilesMatch>
        </VirtualHost>
        ```

        ```bash
        a2dissite 000-default
        a2enmod proxy_fcgi setenvif rewrite
        a2ensite kartsnms.conf
        systemctl restart apache2
        systemctl restart php8.1-fpm
        ```

=== "CentOS 8"
    === "NGINX"
        ```
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
         location / {
          try_files $uri $uri/ /index.php?$query_string;
         }
         location ~ [^/]\.php(/|$) {
          fastcgi_pass unix:/run/php-fpm-kartsnms.sock;
          fastcgi_split_path_info ^(.+\.php)(/.+)$;
          include fastcgi.conf;
         }
         location ~ /\.(?!well-known).* {
          deny all;
         }
        }
        ```

        > NOTE: If this is the only site you are hosting on this server (it
        > should be :)) then you will need to disable the default site.

        Delete the `server` section from `/etc/nginx/nginx.conf`

        ```
        systemctl enable --now nginx
        systemctl enable --now php-fpm
        ```

    === "Apache"
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

          # Enable http authorization headers
          <IfModule setenvif_module>
            SetEnvIfNoCase ^Authorization$ "(.+)" HTTP_AUTHORIZATION=$1
          </IfModule>

          <FilesMatch ".+\.php$">
            SetHandler "proxy:unix:/run/php-fpm-kartsnms.sock|fcgi://localhost"
          </FilesMatch>
        </VirtualHost>
        ```

        > NOTE: If this is the only site you are hosting on this server (it
        > should be :)) then you will need to disable the default site. `rm -f /etc/httpd/conf.d/welcome.conf`

        ```
        systemctl enable --now httpd
        systemctl enable --now php-fpm
        ```

=== "Debian 11"
    === "NGINX"
        ```bash
        vi /etc/nginx/sites-enabled/kartsnms.vhost
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
         location / {
          try_files $uri $uri/ /index.php?$query_string;
         }
         location ~ [^/]\.php(/|$) {
          fastcgi_pass unix:/run/php-fpm-kartsnms.sock;
          fastcgi_split_path_info ^(.+\.php)(/.+)$;
          include fastcgi.conf;
         }
         location ~ /\.(?!well-known).* {
          deny all;
         }
        }
        ```

        ```bash
        rm /etc/nginx/sites-enabled/default
        systemctl reload nginx
        systemctl restart php8.2-fpm
        ```

## SELinux

=== "Ubuntu 22.04"
    SELinux not enabled by default

=== "Ubuntu 20.04"
    SELinux not enabled by default

=== "CentOS 8"
    Install the policy tool for SELinux:

    ```
    dnf install policycoreutils-python-utils
    ```

    <h3>Configure the contexts needed by KartsNMS</h3>

    ```
    semanage fcontext -a -t httpd_sys_content_t '/opt/kartsnms/html(/.*)?'
    semanage fcontext -a -t httpd_sys_rw_content_t '/opt/kartsnms/(rrd|storage)(/.*)?'
    semanage fcontext -a -t httpd_log_t "/opt/kartsnms/logs(/.*)?"
    semanage fcontext -a -t bin_t '/opt/kartsnms/kartsnms-service.py'
    restorecon -RFvv /opt/kartsnms
    setsebool -P httpd_can_sendmail=1
    setsebool -P httpd_execmem 1
    chcon -t httpd_sys_rw_content_t /opt/kartsnms/.env
    ```

    <h3>Allow fping</h3>

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

    Additional SELinux problems may be found by executing the following command

    ```
    audit2why < /var/log/audit/audit.log
    ```

=== "Debian 11"
    SELinux not enabled by default

## Allow access through firewall

=== "Ubuntu 22.04"
    Firewall not enabled by default

=== "Ubuntu 20.04"
    Firewall not enabled by default

=== "CentOS 8"

    ```
    firewall-cmd --zone public --add-service http --add-service https
    firewall-cmd --permanent --zone public --add-service http --add-service https
    ```

=== "Debian 11"
    Firewall not enabled by default


## Enable lnms command completion

This feature grants you the opportunity to use tab for completion on lnms commands as you would
for normal linux commands.

```
ln -s /opt/kartsnms/lnms /usr/bin/lnms
cp /opt/kartsnms/misc/lnms-completion.bash /etc/bash_completion.d/
```

## Configure snmpd

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

## Cron job

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

## Enable the scheduler

```
cp /opt/kartsnms/dist/kartsnms-scheduler.service /opt/kartsnms/dist/kartsnms-scheduler.timer /etc/systemd/system/

systemctl enable kartsnms-scheduler.timer
systemctl start kartsnms-scheduler.timer
```

## Copy logrotate config

KartsNMS keeps logs in `/opt/kartsnms/logs`. Over time these can
become large and be rotated out.  To rotate out the old logs you can
use the provided logrotate config file:

```
cp /opt/kartsnms/misc/kartsnms.logrotate /etc/logrotate.d/kartsnms
```

## Web installer

Now head to the web installer and follow the on-screen instructions.

<http://kartsnms.example.com/install>

The web installer might prompt you to create a `config.php` file in
your kartsnms install location manually, copying the content displayed
on-screen to the file. If you have to do this, please remember to set
the permissions on config.php after you copied the on-screen contents
to the file. Run:

```
chown kartsnms:kartsnms /opt/kartsnms/config.php
```

## Final steps

That's it!  You now should be able to log in to
<http://kartsnms.example.com/>.  Please note that we have not covered
 HTTPS setup in this example, so your KartsNMS install is not secure
 by default.  Please do not expose it to the public Internet unless
 you have configured HTTPS and taken appropriate web server hardening
 steps.

## Add the first device

We now suggest that you add localhost as your first device from within the WebUI.

## Troubleshooting

If you ever have issues with your install, run validate.php:

```
sudo su - kartsnms
./validate.php
```

There are various options for getting help listed on the KartsNMS web
site: <https://www.itkarts.com/#support>

## What next?

Now that you've installed KartsNMS, we'd suggest that you have a read
of a few other docs to get you going:

- [Performance tuning](../Support/Performance.md)
- [Alerting](../Alerting/index.md)
- [Device Groups](../Extensions/Device-Groups.md)
- [Auto discovery](../Extensions/Auto-Discovery.md)

## Closing

We hope you enjoy using KartsNMS. If you do, it would be great if you
would consider opting into the stats system we have, please see [this
page](../General/Callback-Stats-and-Privacy.md) on
what it is and how to enable it.

If you would like to help make KartsNMS better there are [many ways to
help](../Support/FAQ.md#a-namefaq9-what-can-i-do-to-help). You
can also [back KartsNMS on Open Collective](https://t.kartsn.ms/donations).
