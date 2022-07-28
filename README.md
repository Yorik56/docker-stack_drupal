# docker-stack_drupal
Fresh installation of Drupal (PHP 8, APACHE, MYSL, PHPMYADMIN, DRUPAL 9.4, drupal/gin THEME)

# Prerequisite

> Windows

- Git
- WSL
- Composer
- Docker-desktop

[Documentation docker desktop](https://docs.docker.com/desktop/install/windows-install/)

> Linux 

- Git
- Docker 
- Docker-compose

[Documentation docker](https://docs.docker.com/desktop/install/linux-install/)
[Documentation docker compose](https://docs.docker.com/compose/install/compose-plugin/#install-using-the-repository)




# Installation 

> Clone this repo at the root of your project
```shell
git clone https://github.com/Yorik56/docker-stack_drupal
```

> Installation of the dependencies
```shell
composer install
```

> Installation of the docker stack
```shell
docker-compose up --build
```

> Lauch the website 
http://localhost:8080

> Configuration of the database (the parameters are located in the docker-compose file)
- host database: mysql
- database user: root
- database name: drupal
- database password: drupal 
- database port listening: 3306

![image](https://user-images.githubusercontent.com/25177878/181411963-0aad27e4-81d0-49f3-9cba-28670e6653ce.png)
