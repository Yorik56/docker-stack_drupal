# docker-stack_drupal
Fresh installation of Drupal (PHP 8, APACHE, MYSL, PHPMYADMIN, DRUPAL 9.4, drupal/gin THEME)

# Installation 

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
