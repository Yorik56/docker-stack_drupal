# docker-stack_drupal
Fresh installation of Drupal (PHP 8, APACHE, MYSL, PHPMYADMIN, DRUPAL 9.4, drupal/gin THEME)

> Containers 

- php-apache-environment
- mysql 
- phpmyadmin

> Images

- php:8.0-apache
- mysql:latest
- phpmyadmin/phpmyadmin:latest

> [/docker-compose.yml](https://github.com/Yorik56/docker-stack_drupal/blob/main/docker-compose.yml)

```yaml
version: '3.8'
services:
  php-apache-environment:
    container_name: php
    build: .
    volumes:
      - ./:/app
    ports:
      - 8080:80
  mysql:
    image: mysql
    command: --default-authentication-plugin=mysql_native_password
    container_name: mysql
    environment:
      MYSQL_ROOT_PASSWORD: drupal
      MYSQL_DATABASE: drupal
    ports:
      - "6033:3306"
    volumes:
      - ./dbdata:/var/lib/mysql
  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    container_name: phpmyadmin
    links:
      - mysql
    environment:
      PMA_HOST: mysql
      PMA_PORT: 3306
      PMA_ARBITRARY: 1
    restart: always
    ports:
      - 8081:80
```

> [/Dockerfile](https://github.com/Yorik56/docker-stack_drupal/blob/main/Dockerfile)

```dockerfile
# Dockerfile
FROM php:8.0-apache

ENV COMPOSER_ALLOW_SUPERUSER=1

EXPOSE 80
WORKDIR /app

# git, unzip & zip are for composer
RUN apt-get update -qq && \
    apt-get install -qy \
    git \
    libpng-dev \
    gnupg \
    unzip \
    zip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# PHP Extensions
RUN docker-php-ext-install gd
RUN docker-php-ext-install -j$(nproc) opcache pdo_mysql
COPY php/conf/php.ini /usr/local/etc/php/conf.d/app.ini

# Apache
#COPY errors /errors
COPY php/conf/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY php/conf/apache.conf /etc/apache2/conf-available/z-app.conf
COPY . /app
RUN chmod 770 /app/web/sites/default/files/
RUN chmod 660 /app/web/sites/default/settings.php

RUN a2enmod rewrite remoteip && \
    a2enconf z-app


```

# Prerequisite

> Windows

- Git
- WSL2
- Composer (globally installed)
- Docker-desktop

[Documentation docker desktop](https://docs.docker.com/desktop/install/windows-install/)

> Linux 

- Git
- Composer (globally installed)
- Docker 
- Docker-compose

[Documentation docker](https://docs.docker.com/desktop/install/linux-install/)
[Documentation docker compose](https://docs.docker.com/compose/install/compose-plugin/#install-using-the-repository)




# Installation 

> Clone this directory which will be the root of your project
```shell
git clone https://github.com/Yorik56/docker-stack_drupal project_name
```

> Installation of the dependencies (at the root of your project)
```shell
composer install
```

> Installation of the docker stack (at the root of your project)
```shell
docker-compose up --build
```

> Lauch the website (first wait for the end of the docker stack installation)
http://localhost:8080

> Configuration of the database (the parameters are located in the [docker-compose](https://github.com/Yorik56/docker-stack_drupal/blob/main/docker-compose.yml) file)
- host database: mysql
- database user: root
- database name: drupal
- database password: drupal 
- database port listening: 3306

# Extensions & Themes installation

> Launch the PHP container 

```shell
docker exec -it php /bin/bash
```

> Enable theme gin (at the root of the project "/app") 

```shell
vendor/bin/drush theme:enable gin
```

> Set gin as default theme (at the root of the project "/app")

```shell
vendor/bin/drush cset system.theme default gin
Do you want to update default key in system.theme config? (yes/no) [yes]: (ENTER)
```
> Set gin as admin theme (at the root of the project "/app")

```shell
vendor/bin/drush cset system.theme admin gin
Do you want to update default key in system.theme config? (yes/no) [yes]: (ENTER)
```

> Enable modules admin_toolbar, gin_toolbar (at the root of the project "/app") 

```shell
vendor/bin/drush en admin_toolbar admin_toolbar_tools gin_toolbar
```

> Gin configurations 
- http://localhost:8080/admin/appearance/settings/gin

![image](https://user-images.githubusercontent.com/25177878/181593484-3c966118-dae4-4c75-9a0c-0299596f1ac0.png)



![image](https://user-images.githubusercontent.com/25177878/181411963-0aad27e4-81d0-49f3-9cba-28670e6653ce.png)
