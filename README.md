# Install web system

- Install  apache2, mysql,phpmyadmin

```sh

sudo apt-get install apache2 -y
sudo apt-get install mysql -y
```
- Install php 7.4

``` sh
sudo apt-get update
sudo apt -y install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get install php7.4 -y
sudo apt-get install php7.4-{bcmath,bz2,intl,gd,mbstring,mysql,zip,fpm,curl,xml} -y
 ```

#### Config Apache2

```sh
sudo cp 000-default.conf  /etc/apache2/sites-available/ 
sudo a2enmod rewrite
sudo service apache2 restart


sudo mysql -u root -p
CREATE DATABASE OCR CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
sudo mysql -u root dascam < hoivan2.sql
use mysql
UPDATE user SET plugin='mysql_native_password' WHERE User='root';
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'lopital@123';

```


#### Config Laravel and Python

```sh
sudo cp .env.example .env
sudo apt install composer
sudo composer install
```
If can't install composer, please install thought php:
```sh
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
HASH="$(wget -q -O - https://composer.github.io/installer.sig)"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
```

``` sh

sudo php artisan cache:clear
sudo service apache2 restart
```

### php laravel run
```sh
php artisan serve
```


