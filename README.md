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