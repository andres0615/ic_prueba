# Prueba tecnica inncloud
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
3. Configurar la base de datos en el archivo **.env**:
    <br>
    ```text
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=ic_prueba
    DB_USERNAME=root
    DB_PASSWORD=toor
    ```
4.  Configurar la **APP_URL** en el archivo **.env**:
	<br>
	```text
	APP_URL=http://127.0.0.1:8000
	```
5. Montar la base de datos usando las migraciones de **Laravel**, con el comando:
	<br>
	```shell
	php artisan migrate
	```
6. Añadir informacion a la base de datos usando los seeders de **Laravel**, con el comando:
	<br>
	```shell
	php artisan db:seed
	```
	Opcionalmente si se desea repopular la base de datos se puede usar el comando:
	<br>
	```shell
	php artisan migrate:refresh --seed
	```