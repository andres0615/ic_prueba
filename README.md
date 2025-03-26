# Prueba tecnica inncloud
## Overview
Este proyecto es una aplicacion SPA desarrollada usando las siguientes tecnologias:
- Laravel 
- Vue.js
- Bootstrap
- PHPUnit
## Instalacion
1. Clonar el proyecto usando **github CLI** con el siguiente comando:
    ```shell
    gh repo clone andres0615/ic_prueba
    ```
    Tambien se puede descargar en formato **.zip** o mediante las demas opciones que ofrece **github**.

2. En la raiz del proyecto, instalar las dependencias usando **composer**, con el siguiente comando:
    ```shell
    composer install
    ```
3. Crear el archivo `.env` copiandolo desde el archivo `.env.example`, para esto en la raiz del proyecto se puede usar el comando:
	<br>
	```shell
	cp .env.example .env
	```
4. Configurar la base de datos en el archivo `.env`:
    <br>
    ```text
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=ic_prueba
    DB_USERNAME=root
    DB_PASSWORD=toor
    ```
5.  Configurar la **APP_URL** en el archivo `.env`:
	<br>
	```text
	APP_URL=http://127.0.0.1:8000
	```
    Asegurarse que la url ingresada NO termine en slash `/`.
6. Montar la base de datos usando las migraciones de **Laravel**, con el comando:
	<br>
	```shell
	php artisan migrate
	```
7. Añadir informacion a la base de datos usando los seeders de **Laravel**, con el comando:
	<br>
	```shell
	php artisan db:seed
	```
	Opcionalmente si se desea repopular la base de datos se puede usar el comando:
	<br>
	```shell
	php artisan migrate:refresh --seed
	```
8. Servir la aplicacion usando el comando:
	<br>
	```text
	php artisan serve
	```
    En este punto ya se puede ingresar a la aplicacion con la url que se muestra en la consola.
9. Opcionalmente se pueden correr los tests con el comando:
	<br>
	```text
	php artisan test
	```