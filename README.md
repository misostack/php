# PHP Headfirst

## Specification

> Build a personal CV website with PHP and MySQL
>
> - Landing Page
> - Portfolio Page
> - Admin Page

## Technical

### Install Docker

- Follow this **[link](https://docs.docker.com/engine/install/ubuntu/)**
```shell script
sudo apt-get update
sudo apt-get install \
    apt-transport-https \
    ca-certificates \
    curl \
    gnupg-agent \
    software-properties-common
# verify
```

> sudo docker run hello-world

> Got permission denied while trying to connect to the Docker daemon socket at unix:///var/run/docker.sock: Get http://%2Fvar%2Frun%2Fdocker.sock/v1.40/images/json: dial unix /var/run/docker.sock: connect: permission denied

Fixed : https://www.digitalocean.com/community/questions/how-to-fix-docker-got-permission-denied-while-trying-to-connect-to-the-docker-daemon-socket

- https://docs.docker.com/engine/install/linux-postinstall/

```shell script
sudo chmod 666 /var/run/docker.sock
```

#### References

- https://hackernoon.com/how-to-debug-php-container-with-xdebug-and-phpstorm-1b2k3yjo
- https://gist.github.com/chadrien/c90927ec2d160ffea9c4
- https://github.com/paslandau/docker-php-tutorial

### Install PHP on Local Environment

#### References

- https://linuxize.com/post/how-to-install-php-on-ubuntu-18-04/
- https://tecadmin.net/install-php-7-on-ubuntu/
- https://www.php.net/supported-versions.php
- https://www.digitalocean.com/community/tutorials/how-to-run-multiple-php-versions-on-one-server-using-apache-and-php-fpm-on-ubuntu-18-04
- https://linuxize.com/post/how-to-install-and-configure-nextcloud-on-ubuntu-18-04/

> Current lastest version : 7.4 
>

**A. Traditional**

1.Install PHP

```shell script
sudo apt-get install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get install -y php7.4
```

2.Install PHP Extension

```shell script
sudo apt install php-[extname]
```

3.Common PHP Extensions

- https://wordpress.stackexchange.com/questions/42098/what-are-php-extensions-and-libraries-wp-needs-and-or-uses
- https://github.com/johnbillion/ext
- https://laravel.com/docs/7.x#server-requirements
- https://www.jundat95.com/2019/03/install-pecl-in-ubuntu-1804-lts.html

4.Install php for dev environments

- https://xdebug.org/docs/install#configure-php

```shell script
sudo apt-get install php7.4-dev
pecl help
sudo pecl install xdebug
```

> Build process completed successfully
  Installing '/usr/lib/php/20190902/xdebug.so'
  install ok: channel://pecl.php.net/xdebug-2.9.6
  configuration option "php_ini" is not set to php.ini location
  You should add "zend_extension=/usr/lib/php/20190902/xdebug.so" to php.ini

```shell script
php -m
```

```ini
[Zend Modules] 
Xdebug
Zend OPcache
```

**Debug**

- Shift + F9 : Start Debugging
- Shift + F8 : Next
- Shift + F7 : Step Into