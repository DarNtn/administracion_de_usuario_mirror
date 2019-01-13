# Administración escuelas

## Development

1. Instalar dependencias

```sh
sudo apt-get install apache
sudo apt-get install php7.0
sudo apt-get install php-mysql
sudo apt-get install phpunit
```

2. Configurar para desarrollo

Editar el archivo __funciones/conexion/php_conection.php__ con las variables de mysql

```php
$db_host = "localhost:3306";
$db_user = "root";
$db_esquema = "innovasystemcom_jardin";
$db_password = "mi_clave";
```

3. Linkear los archivos 

```sh
sudo ln -s /home/[user]/proyects/escuelas/administracion_usuarios /var/www/html/escuelas
```

4. Cargar la db

```sh
mysql -u user -p
```

```sh
source /home/[user]/proyects/escuelas/administracion_usuarios/baseJardin.sql
```

5. Instalar composer y depdendencias

```sh
curl -sS https://getcomposer.org/installer | php 
 sudo mv composer.phar /usr/bin/composer
```

Para más info https://getcomposer.org/download/

```sh
composer install
```

6. Entrar a la página

http://localhost/escuelas/index.php


### Instalar nuevas dependencias

```sh
composer require phpmailer/phpmailer # nombre de la dependencia
```

### Notas

* Se tuvo que ignorar el archivo funciones/conexion/php_conection.php para poder correr la db en diferentes máquinas


### Links

https://www.howtoforge.com/tutorial/install-apache-with-php-and-mysql-on-ubuntu-16-04-lamp/

https://github.com/phpbrew/phpbrew

https://getcomposer.org/


<<<<<<< Updated upstream
<?php echo php_ini_loaded_file(); ?>
=======
### Configurar mail

https://phppot.com/php/gmail-email-inbox-using-php-with-imap/
>>>>>>> Stashed changes
